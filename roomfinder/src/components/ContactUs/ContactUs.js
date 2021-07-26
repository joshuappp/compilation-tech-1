import { useState } from 'react';
import classes from './ContactUs.module.css';
import Popup from '../Popup/Popup';
import Spinner from '../Spinner/Spinner';
import Backdrop from '../Backdrop/Backdrop';
import firebase from '../../firebaseStorage/firebase';

const ContactUs = (props) => {

    const database = firebase.firestore();

    const [spinnerState,setSpinnerState] = useState({loading: false,message: ""});
    

    const [formData,setFormData] = useState({name: "",contact: "",email: "",description: ""});

    function validatePhoneNumber(input_str) 
    {
        var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

        return re.test(input_str);
    }

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }


    const formHandler = (event) => {
        event.preventDefault();

        if(!validatePhoneNumber(formData.contact)){
            setSpinnerState({loading: false,message: "Enter correct contact"});
            return;
        }else if(!validateEmail(formData.email)){
            setSpinnerState({loading: false,message: "Enter correct email"});
            return;
        }

        setSpinnerState({loading: true,message: ''});

        let the_date = new Date();
        let updatedFormValues = {
            ...formData,
            date: the_date.toString()
        }

        database.collection('roomFinderContacts').add({
            ...updatedFormValues
        }).
        then(response => {
            setFormData({name: "",contact: "",email: "",description: "",date: ""});
            setSpinnerState({loading: false,message: 'Successfully submited'});
        }).
        catch(error=>{
            setSpinnerState({loading: false,message: error.message});
        });
    
    }

    const inputChangedHandler = (event,identifier) => {

        let updateedFormValues = {
                ...formData,
                [identifier]: event.target.value
        }
        setFormData(updateedFormValues);
    }
    const removeModal = () => {
        //
    }
    const removePopUp = () => {
        setSpinnerState({loading: false,message: ""});
    }
    let theSpinner = null;
    let backDrop = null;
    let popup = null;
    if(spinnerState.loading){
        theSpinner = <Spinner />
        backDrop = <Backdrop sideDrawerState={spinnerState.loading} clicked={removeModal}/>
    }
    if((spinnerState.message).length !== 0){
        popup = <Popup message={spinnerState.message} clicked={removePopUp}/>
        backDrop = <Backdrop sideDrawerState={true} clicked={removeModal}/>
    }

    return <div id={props.id}>
               <div className={classes.ContactUs}>
                    <div className={classes.ContactUs__header}>
                        <h1>Contact Us</h1>
                        <div className={classes.ContactUs__underline}></div>
                    </div>
                    {popup}
                    <div className={classes.ContactUs_Spinner}>
                            {backDrop}
                            {theSpinner}
                    </div>
                    
                    <div className={classes.ContactUsContent}>
                            <div className={classes.ContactLeft}>
                                    <div>
                                        <h1>Compilation Tech</h1>
                                    </div>
                                    <div>
                                        <p>We believe that working <strong>Together</strong> we can accomplish <strong>Everything</strong>.</p>
                                    </div>
                                    <div className={classes.ContactInfo}>
                                        <strong>Phone: </strong><span>(+27) 6712 34277</span><br/>
                                        <strong>Email:</strong><span>compilationtech@gmail.com</span>
                                    </div>
                    
                            </div>
                            <div className={classes.ContactRight}>

                                <h1>Get In Toch With Us</h1>
                                <form onSubmit={formHandler} className={classes.ContactForm}>
                                    <input type="text" name="name" placeholder="Name" value={formData.name} onChange={event => inputChangedHandler(event,"name")} required maxLength="30"/>
                                    <input type="tel" name="telephone" placeholder="Contact" value={formData.contact} onChange={event => inputChangedHandler(event,"contact")} required maxLength="15"/>
                                    <input type="email" name="email" placeholder="Email" value={formData.email} onChange={event => inputChangedHandler(event,"email")} required maxLength="40"/>
                                    <textarea cols="10" rows="5" name="description" placeholder="Description" value={formData.description} onChange={event => inputChangedHandler(event,"description")} required maxLength="100"></textarea>
                                    <button>SUBMIT</button>
                                </form>

                            </div>

                        </div>
            </div>
            <footer className={classes.ContactFooter}>
                    <p>Copyrights © 2021 All Rights Reserved By Compilation Tech</p>
            </footer>
        </div>
}

export default ContactUs;