import {useEffect,useState} from 'react';
import { useSelector } from 'react-redux';
import classes from './DeleteProperty.module.css';
import AvailablePropertyImageCard from '../../components/AvailablePropertyImageCard/AvailablePropertyImageCard';
import DescriptionSection from '../../components/DescriptionSection/DescriptionSection';
import ContactUs from '../../components/ContactUs/ContactUs';
import ImageSlider from '../../components/ImageSlider/ImageSlider';
import { Redirect } from 'react-router-dom';
import firebase from '../../firebaseStorage/firebase';
import Spinner from '../../components/Spinner/Spinner';
import Backdrop from '../../components/Backdrop/Backdrop';
import Popup from '../../components/Popup/Popup';
const DeleteProperty = () => {

    const username = useSelector(state => {
        return state.auth.username;
    });

    const [arrayOfArraysOfImageObjects,setArrayOfArraysOfImageObjects] = useState([]);
    const [spinnerState,setSpinnerState] = useState({loading: false,message: ""});

    const firestoreRef = firebase.firestore();
    const storageRef = firebase.storage().ref('roomFinder');

    useEffect(() =>{
        console.log("3");
        let arraysOfObject = [];
        let tempArraysOfObject = [];
        firestoreRef.collection('roomFinder').onSnapshot(snapshort => {
            let changes = snapshort.docChanges();
            
            changes.forEach(change => {
                const id = change.doc.id;
                if(id.includes(username)){
                    const data = change.doc.data();
                
                    if(change.type === "added"){
                        tempArraysOfObject.push([{'province': data.province,'section': data.section,'location': data.location,'address': data.address,'contact': data.contact,'price': data.price,'id': change.doc.id,'imageUrl': data.imageUrl}]);

                    }else if(change.type === "removed"){
                        //arraysOfObject.push([{'province': data.province,'section': data.section,'location': data.location,'address': data.address,'contact': data.contact,'price': data.price,'id': change.doc.id,'imageUrl': data.imageUrl}]);
                    }

                }
                
            });
            if(tempArraysOfObject.length !== 0){

                const reversedArray = tempArraysOfObject.reverse();
                for(let x=0; x<10; x++){
                    
                    if(x < reversedArray.length){
                        arraysOfObject.push(reversedArray[x]);
                    }else{
                        break;
                    }
                }
                setArrayOfArraysOfImageObjects(arraysOfObject);

            }
            
            if(spinnerState.loading){
                setSpinnerState({loading: false,message: ''});
            }
        });
    },[spinnerState]);

    const [viewFullInfo, setViewFullInfo] = useState(false);
    const [sliderData, setSliderData] = useState([]);
    
    const viewFullInfoMethod = (id) => {
        setViewFullInfo(!viewFullInfo);
        arrayOfArraysOfImageObjects.forEach(arr => {
            if(arr[0].id === id){
                setSliderData(arr);
            }
        });
        
    }
    

    const authenticated = useSelector(state => {
        return state.auth.authenticated;
    });


    const deleteImageMethod = (id) => {
        setSpinnerState({loading: true,message: ''});
        
        firestoreRef.collection('roomFinder').doc(id).delete().then( () =>{
            storageRef.child(id).delete().then(() => {
                  console.log("Sucessfully deleted room");
              }).catch(() => {
                setSpinnerState({loading: false,message: 'Failed to deleted'});
              });
            
        }).catch(() =>{
            setSpinnerState({loading: false,message: 'Failed to deleted'});
        });

    }

    const province = arrayOfArraysOfImageObjects.length > 0 ? arrayOfArraysOfImageObjects[0][0].province : '';
    const section =  arrayOfArraysOfImageObjects.length > 0 ? arrayOfArraysOfImageObjects[0][0].section : '';

    let deleteProperty = null;
    let login = null;
    let imageComp = null;

    if(arrayOfArraysOfImageObjects.length > 0){
        imageComp = <div className={classes.DeletePropertyImageOuterContainer}>
                        <div className={classes.DeletePropertyImageInnerContainer}>
                            <AvailablePropertyImageCard the_images_arry={arrayOfArraysOfImageObjects} deleteProperty="display" clicked={viewFullInfoMethod} clickedDelete={deleteImageMethod}/>
                        </div>
                    </div>
    
    }

    if(authenticated){

        deleteProperty =  <div className={classes.DeleteProperty}>

                <div className={classes.DeletePropertyBackgroundContent}>

                        <div className={classes.DeletePropertyHeader}>
                            <div className={classes.ProvinceHeader}>
                                <h2>Province: {province}</h2> 
                            </div>
                            <div className={classes.SectionHeader}>
                                <h2>Section: {section}</h2> 
                            </div>
                        </div>
                    
                </div>
                {imageComp}

           </div>;
        
        }else{
            login = <Redirect to={{
                    pathname: "/login",
                    state: { referrer: "/delete_property" }
                }} />;
        }


        
        let displayAvailableProperty = null;

        let displayViewFullImagesInfo = null;

        if(viewFullInfo){
            displayViewFullImagesInfo = <ImageSlider slides={sliderData} clicked={viewFullInfoMethod}/>;
        }else{
            displayAvailableProperty = <div>
                                            {deleteProperty}
                                            {login}
                                            <DescriptionSection />
                                            <ContactUs />
                                       </div>;
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

        return <div>
                   {popup}
                    <div className={classes.DeleteProperty_Spinner}>
                            {backDrop}
                            {theSpinner}
                    </div>
                   {displayViewFullImagesInfo}
                   {displayAvailableProperty}
               </div>;
}

export default DeleteProperty;