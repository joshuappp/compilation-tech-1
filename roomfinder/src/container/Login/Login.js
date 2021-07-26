import classes from './Login.module.css';
import DescriptionSection from '../../components/DescriptionSection/DescriptionSection';
import ContactUs from '../../components/ContactUs/ContactUs';
import Spinner from '../../components/Spinner/Spinner';
import Backdrop from '../../components/Backdrop/Backdrop';
import Popup from '../../components/Popup/Popup';
import { useState } from 'react';
import { Redirect } from 'react-router-dom';
import { useDispatch,useSelector } from 'react-redux';
import * as actions from '../../store/action/index';
import firebase from '../../firebaseStorage/firebase';
const Login = (props) => {

    const dispatch = useDispatch();
    const authenticated = useSelector(state => {
        return state.auth.authenticated;
    });

    const firestoreRef = firebase.firestore();

    const [formData,setFormData] = useState({username: "",password: ""});
    const [spinnerState,setSpinnerState] = useState({loading: false,message: ""});

    const [register,setRegister] = useState(false);
    const [resertPasswordAuth,setResertPasswordAuth] = useState(false);
    
    const registerMethod = () => {
        setRegister(true);
    }
    const resertPasswordAuthMethod = () => {
        setResertPasswordAuth(true);
    }

    function validateEmail(username) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(username).toLowerCase());
    }

    const inputChangedHandler = (event,identifier) => {

        let updateedFormValues = {
                ...formData,
                [identifier]: event.target.value
        }
        setFormData(updateedFormValues);
    }

    const formHandler = (event) => {
        event.preventDefault();

        setSpinnerState({loading: true,message: ''});

        if(!validateEmail(formData.username)){
            setSpinnerState({loading: false,message: "Enter correct email"});
            return;
        }else if(formData.password.length < 4){
            setSpinnerState({loading: false,message: "Atleast 4 characters of Password"});
            return;
        }

        let query = firestoreRef.collection('roomFinderRegistration');
        query = query.where('username', '==', formData.username);
        query = query.where('password', '==', formData.password);
        query.get().then(() => {
            setSpinnerState({loading: false,message: ''});
            dispatch(actions.authentication(true, formData.username,''));
            
        }).catch(()=>{
            setSpinnerState({loading: false,message: 'Failed to submit, please try again'});
        });

    }

    const removePopUp = () => {
        setSpinnerState({loading: false,message: ""});
    }

    let theSpinner = null;
    let backDrop = null;
    let popup = null;

    if(spinnerState.loading){
        theSpinner = <Spinner />
        backDrop = <Backdrop sideDrawerState={spinnerState.loading} />
    }
    if((spinnerState.message).length !== 0){
        popup = <Popup message={spinnerState.message} clicked={removePopUp}/>
        backDrop = <Backdrop sideDrawerState={true} />
    }

    let login = null;
    if(!authenticated){

        login =  <div className={classes.Login}>
        
                <div className={classes.LoginBackgroundContent}>

                    <div className={classes.LoginHeader}>
                        <h1>LANDLORD TO LOGIN</h1>
                    </div>
                    <div className={classes.LoginUnderline}></div>
                    {popup}
                    <div className={classes.Login_Spinner}>
                            {backDrop}
                            {theSpinner}
                    </div>
                    <div className={classes.LoginFormCotainer}>
                            <form onSubmit={formHandler} className={classes.LoginForm}>
                                    <label htmlFor="username">Username*</label>
                                    <input type="text" name="username" placeholder="e.g name@gmail.com" value={formData.name} onChange={event => inputChangedHandler(event,"username")} required maxLength="30"/>
                                    <label htmlFor="password">Password*</label>
                                    <input type="password" name="password" placeholder="" value={formData.name} onChange={event => inputChangedHandler(event,"password")} required minLength="4" maxLength="40"/>
                                    <button>SUBMIT</button>
                            </form>
                    </div>
                    <div className={classes.Register}>
                        <p>Not Registered, Please click here to <span onClick={registerMethod}>register</span></p>
                    </div>
                    <div className={classes.ResertPassword}>
                        <p>If You Forgotten The Password, Please click here to <span onClick={resertPasswordAuthMethod}>reset</span></p>
                    </div>

                    </div>
            </div>;

       }
       console.log(props.location.state.referrer);
        return <div>
                    {register ? <Redirect to={{
                                pathname: "/register",
                                state: { referrer: props.location.state.referrer }
                                }} /> : resertPasswordAuth ? <Redirect to={{
                                    pathname: "/resert_password_auth",
                                    state: { referrer: props.location.state.referrer }
                                }} /> : authenticated ? <Redirect to={props.location.state.referrer}/> : login
                                }
                    <DescriptionSection />
                    <ContactUs />
              </div>;
}
export default Login;