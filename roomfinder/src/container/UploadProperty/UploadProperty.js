import classes from './UploadProperty.module.css';
import DescriptionSection from '../../components/DescriptionSection/DescriptionSection';
import ContactUs from '../../components/ContactUs/ContactUs';
import Spinner from '../../components/Spinner/Spinner';
import Backdrop from '../../components/Backdrop/Backdrop';
import Popup from '../../components/Popup/Popup';
import { useSelector } from 'react-redux';
import { Redirect } from 'react-router-dom';
import { useState } from 'react';
import firebase from '../../firebaseStorage/firebase';
import { v4 as uuidv4 } from 'uuid';

const UploadProperty = () => {

    const username = useSelector(state => {
        return state.auth.username;
    });

    const storageRef = firebase.storage().ref('roomFinder');
    const firestoreRef = firebase.firestore();

    const formDataObject = {province: "Gauteng",location: "",section: "",price: "",address: "",contact: ""};

    const [formData,setFormData] = useState(formDataObject);
    const [spinnerState,setSpinnerState] = useState({loading: false,message: ""});
    const [imageFile,setImageFile] = useState(null);

    const [fileInput,setFileInput] = useState(false);

    const authenticated = useSelector(state => {
        return state.auth.authenticated;
    });

    const inputChangedHandler = (event,identifier) => {
        
        let updateedFormValues = {
                ...formData,
                [identifier]: event.target.value
        }
        setFormData(updateedFormValues);
    }
    const inputImageChangedHandler = (data) => {
        
        if(data.size > 30000000){
            setSpinnerState({loading: false,message: 'Image size is more than 30Mb'});
            setFileInput(!fileInput);
            return;
        }
        setImageFile(data);
    }

    const formHandler = (event) =>  {
        event.preventDefault();

        setSpinnerState({loading: true,message: ''});
        const imageId = uuidv4();
        const fileRef = storageRef.child(imageId+''+username);
        fileRef.put(imageFile).then(async () => {
                const the_date = new Date();  
                firestoreRef.collection('roomFinder').doc(imageId+''+username).set({
                    ...formData,
                    imageUrl: await fileRef.getDownloadURL(),
                    date: the_date.toString()
                }).then(() => {
                    setFormData(formDataObject);
                    setFileInput(!fileInput);
                    setSpinnerState({loading: false,message: 'Successfully submited'});
                }).catch(()=>{
                    setSpinnerState({loading: false,message: 'Failed to submit, please try again'});
                });
            
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

    let uploadProperty = null;
    let login = null;

    if(authenticated){
        uploadProperty = <div className={classes.UploadProperty}>
                    <div className={classes.UploadPropertyBackgroundContent}>

                            <div className={classes.UploadPropertyHeader}>
                                <h1>LANDLORD TO UPLOAD ROOM</h1>
                            </div>
                            <div className={classes.UploadPropertyUnderline}></div>
                            {popup}
                            <div className={classes.Login_Spinner}>
                                    {backDrop}
                                    {theSpinner}
                            </div>
                            <div className={classes.UploadPropertyFormCotainer}>
                                    <form onSubmit={formHandler} className={classes.UploadPropertyForm}>

                                            <label htmlFor="province">Province*</label>
                                            <select id="province" onChange={event => inputChangedHandler(event,"province")}>
                                                <option value="Gauteng">Gauteng</option>
                                                <option value="North West">North West</option>
                                                <option value="Mpumalanga">Mpumalanga</option>
                                                <option value="Kwazulu Natal">Kwazulu Natal</option>
                                                <option value="Western Cape">Western Cape</option>
                                                <option value="Limpopo">Limpopo</option>
                                                <option value="Northen Cape">Northen Cape</option>
                                                <option value="Free State">Free State</option>
                                                <option value="Eastern Cape">Eastern Cape</option>
                                            </select>
                                            <label htmlFor="location">Location*</label>
                                            <input type="text" name="location" placeholder="e.g Soweto" value={formData.location} onChange={event => inputChangedHandler(event,"location")} required maxLength="30"/>
                                            <label htmlFor="section">Section*</label>
                                            <input type="text" name="section" placeholder="e.g Pimville" value={formData.section} onChange={event => inputChangedHandler(event,"section")} required maxLength="30"/>
                                            <label htmlFor="price">Price*</label>
                                            <input type="text" name="price" value={formData.price} onChange={event => inputChangedHandler(event,"price")} required maxLength="7"/>
                                            <label htmlFor="address">Address*</label>
                                            <input type="text" name="address" placeholder="e.g Main Street" value={formData.address} onChange={event => inputChangedHandler(event,"address")} required maxLength="50"/>
                                            <label htmlFor="contact">Contact*</label>
                                            <input type="text" name="contact" value={formData.contact} onChange={event => inputChangedHandler(event,"contact")} required maxLength="10"/>
                                            <label htmlFor="image">Image*</label>
                                            <input type="file" name="image" accept="image/*" key={fileInput || '' }  onChange={event => inputImageChangedHandler(event.target.files[0])} required/>
                                            <button>SUBMIT</button>
                                    </form>
                            </div>
                            
                    </div>
                    

                </div>;
           }else{
               login = <Redirect to={{
                            pathname: "/login",
                            state: { referrer: "/upload_property" }
                        }} />;
           }

           return <div>
                      {uploadProperty}
                      {login}
                      <DescriptionSection />
                      <ContactUs />
                  </div>;
}
export default UploadProperty;