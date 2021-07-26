import classes from './Register.module.css';
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
const Register = (props) => {

    const dispatch = useDispatch();
    const authenticated = useSelector(state => {
        return state.auth.authenticated;
    });
    const formDataObject = {username: "",password: "",confirmpassword: "",primaryschool: ""};

    const firestoreRef = firebase.firestore();

    const [formData,setFormData] = useState(formDataObject);
    const [spinnerState,setSpinnerState] = useState({loading: false,message: ""});

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
        }else if(formData.password !== formData.confirmpassword){
            setSpinnerState({loading: false,message: "Passwords are not matching"});
            return;
        }else if(formData.password.length < 4 || formData.confirmpassword.length < 4){
            setSpinnerState({loading: false,message: "Enter atleast 4 characters of Password"});
            return;
        }else if(formData.primaryschool.length === 0){
            setSpinnerState({loading: false,message: "Primary school cannot be empty"});
            return;
        }

        firestoreRef.collection('roomFinderRegistration').add({
            ...formData
        }).then(() => {
            setSpinnerState({loading: false,message: ''});
            setFormData(formDataObject);
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
        backDrop = <Backdrop sideDrawerState={true}/>
    }

    let register = null;
    if(!authenticated){
       register =   <div className={classes.Register}>
        
                <div className={classes.RegisterBackgroundContent}>

                    <div className={classes.RegisterHeader}>
                        <h1>LANDLORD TO REGISTER</h1>
                    </div>
                    <div className={classes.RegisterUnderline}></div>
                    {popup}
                    <div className={classes.Login_Spinner}>
                            {backDrop}
                            {theSpinner}
                    </div>
                    <div className={classes.RegisterFormCotainer}>
                            <form onSubmit={formHandler} className={classes.RegisterForm}>
                                    <label htmlFor="username">Username*</label>
                                    <input type="text" name="username" placeholder="e.g name@gmail.com" value={formData.name} onChange={event => inputChangedHandler(event,"username")} required minLength="4" maxLength="30"/>
                                    <label htmlFor="password">Password*</label>
                                    <input type="password" name="password" placeholder="" value={formData.name} onChange={event => inputChangedHandler(event,"password")} required minLength="4"  maxLength="40"/>
                                    <label htmlFor="confirmpassword">Confirm Password*</label>
                                    <input type="password" name="confirmpassword" placeholder="" value={formData.confirm_password} onChange={event => inputChangedHandler(event,"confirmpassword")} required minLength="4" maxLength="40"/>
                                    <label htmlFor="primaryschool">Primary School*</label>
                                    <input type="text" name="primaryschool" placeholder="" value={formData.name} onChange={event => inputChangedHandler(event,"primaryschool")} required minLength="1" maxLength="30"/>
                                    <button>SUBMIT</button>
                            </form>
                    </div>
                    </div>
            </div>;
    }
    console.log(props.location.state.referrer);
    return <div>
            { authenticated ? <Redirect to={props.location.state.referre}/> : register}
            <DescriptionSection />
            <ContactUs />
        </div>;
};
 
 export default Register;