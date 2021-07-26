import classes from './ResertPasswordAuthenticate.module.css';
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
const ResertPasswordAuthenticate = (props) => {
    
    const dispatch = useDispatch();
    const authenticated = useSelector(state => {
        return state.auth.authenticated;
    });

    const firestoreRef = firebase.firestore();

    const [formData,setFormData] = useState({username: "",primaryschool: ""});
    const [spinnerState,setSpinnerState] = useState({loading: false,message: ""});
    const [authState,setAuthState] = useState(false);


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
        }else if(formData.primaryschool.length === 0){
            setSpinnerState({loading: false,message: "Primary school cannot be empty"});
            return;
        }
        
        let query = firestoreRef.collection('roomFinderRegistration');
        query = query.where('username', '==', formData.username);
        query = query.where('primaryschool', '==', formData.primaryschool);
        query.get().then((snapshot) => {
                let docId = '';
                snapshot.docs.forEach(doc =>{
                    docId = doc.id;
                });
                setSpinnerState({loading: false,message: ''});
                setAuthState(true);
                dispatch(actions.authentication(false, formData.username,docId));
                
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


    let resertPasswordAuthenticate = null;
    if(!authenticated ){
    resertPasswordAuthenticate =<div className={classes.ResertPasswordAuthenticate}>
             <div className={classes.ResertPasswordAuthenticateBackgroundContent}>

                <div className={classes.ResertPasswordAuthenticateHeader}>
                    <h1>PROVIDE BELOW DETAILS</h1>
                </div>
                <div className={classes.ResertPasswordAuthenticateUnderline}></div>
                {popup}
                    <div className={classes.Login_Spinner}>
                            {backDrop}
                            {theSpinner}
                    </div>
                <div className={classes.ResertPasswordAuthenticateFormCotainer}>
                        <form onSubmit={formHandler} className={classes.ResertPasswordAuthenticateForm}>
                                <label htmlFor="username">Username*</label>
                                <input type="text" name="username" placeholder="name@gmail.com" value={formData.name} onChange={event => inputChangedHandler(event,"username")} required maxLength="30"/>
                                <label htmlFor="primaryschool">Primary School*</label>
                                <input type="text" name="primaryschool" placeholder="" value={formData.name} onChange={event => inputChangedHandler(event,"primaryschool")} required minLength="1" maxLength="30"/>
                                <button>SUBMIT</button>
                        </form>
                    </div>

                </div>;
        </div>
    }
    console.log(props.location.state.referrer);
    console.log(authState);
return <div>
            {authState ? <Redirect to={{
                                    pathname: "/resert_password",
                                    state: { referrer: props.location.state.referrer}
                                }} /> : authenticated ? <Redirect to="/"/> : resertPasswordAuthenticate}
            <DescriptionSection />
            <ContactUs />
        </div>;
}
export default ResertPasswordAuthenticate;