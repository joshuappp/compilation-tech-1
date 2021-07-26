import classes from './ResertPassword.module.css';
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
const ResertPassword = (props) => {

    const dispatch = useDispatch();
    const authenticated = useSelector(state => {
        return state.auth.authenticated;
    });
    const userId = useSelector(state => {
        return state.auth.userId;
    });


    const firestoreRef = firebase.firestore();

    const [formData,setFormData] = useState({password: "",confirmpassword: ""});
    const [spinnerState,setSpinnerState] = useState({loading: false,message: ""});

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

        if(formData.password !== formData.confirmpassword){
            setSpinnerState({loading: false,message: "Passwords are not matching"});
            return;
        }else if(formData.password.length < 4 || formData.confirmpassword.length < 4){
            setSpinnerState({loading: false,message: "Enter atleast 4 characters of Password"});
            return;
        }

        firestoreRef.collection('roomFinderRegistration').doc(userId).update({
            password: formData.password,
            confirmpassword: formData.confirmpassword
        }).then(() => {
            setSpinnerState({loading: false,message: ''});
            dispatch(actions.authentication(true, formData.username));
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

    let resertPassword = null;
    if(!authenticated){
          resertPassword =  <div className={classes.ResertPassword}>
            <div className={classes.ResertPasswordBackgroundContent}>

                <div className={classes.ResertPasswordHeader}>
                    <h1>LANDLORD TO RESERT PASSWORD</h1>
                </div>
                <div className={classes.ResertPasswordUnderline}></div>
                {popup}
                    <div className={classes.Login_Spinner}>
                            {backDrop}
                            {theSpinner}
                    </div>
                <div className={classes.ResertPasswordFormCotainer}>
                        <form onSubmit={formHandler} className={classes.ResertPasswordForm}>
                                <label htmlFor="location">Password*</label>
                                <input type="password" name="password" placeholder="" value={formData.name} onChange={event => inputChangedHandler(event,"password")} required maxlength="30"/>
                                <label htmlFor="confirmpassword">Confirm Password*</label>
                                <input type="password" name="confirmpassword" placeholder="" value={formData.name} onChange={event => inputChangedHandler(event,"confirmpassword")} required maxlength="30"/>
                                <button>SUBMIT</button>
                        </form>
                    </div>

                </div>
         </div>;
    }
    console.log(props.location.state.referrer);
return <div>
            {authenticated ? <Redirect to={props.location.state.referrer}/> : resertPassword}
            <DescriptionSection />
            <ContactUs />
       </div>;
}
export default ResertPassword;