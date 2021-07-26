import {useEffect,useState} from 'react';
import classes from './AvailableProperty.module.css';
import AvailablePropertyImageCard from '../../components/AvailablePropertyImageCard/AvailablePropertyImageCard';
import DescriptionSection from '../../components/DescriptionSection/DescriptionSection';
import ContactUs from '../../components/ContactUs/ContactUs';
import ImageSlider from '../../components/ImageSlider/ImageSlider';
import firebase from '../../firebaseStorage/firebase';
const AvailableProperty = () => {

    const [arrayOfArraysOfImageObjects,setArrayOfArraysOfImageObjects] = useState([]);

    const firestoreRef = firebase.firestore();

    useEffect(() =>{
        let arraysOfObject = [];
        let tempArraysOfObject = [];
        firestoreRef.collection('roomFinder').onSnapshot(snapshort => {
            let changes = snapshort.docChanges();
            
            changes.forEach(change => {
                const data = change.doc.data();
                
                if(change.type === "added"){
                    tempArraysOfObject.push([{'province': data.province,'section': data.section,'location': data.location,'address': data.address,'contact': data.contact,'price': data.price,'id': change.doc.id,'imageUrl': data.imageUrl}]);

                }else if(change.type === "removed"){
                    //arraysOfObject.push([{'province': data.province,'section': data.section,'location': data.location,'address': data.address,'contact': data.contact,'price': data.price,'id': change.doc.id,'imageUrl': data.imageUrl}]);
                }
            });
            const reversedArray = tempArraysOfObject.reverse();
            for(let x=0; x<10; x++){
                
                if(x < reversedArray.length){
                    arraysOfObject.push(reversedArray[x]);
                }else{
                    break;
                }
            }
            
            setArrayOfArraysOfImageObjects(arraysOfObject);
        });
        
    },[firestoreRef]);

    
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

    const province = arrayOfArraysOfImageObjects.length > 0 ? arrayOfArraysOfImageObjects[0][0].province : '';
    const section =  arrayOfArraysOfImageObjects.length > 0 ? arrayOfArraysOfImageObjects[0][0].section : '';

    let imageComp = null;
    if(arrayOfArraysOfImageObjects.length > 0){
        imageComp = <div className={classes.AvailablePropertyImageOuterContainer}>
                        <div className={classes.AvailablePropertyImageInnerContainer}>
                            <AvailablePropertyImageCard the_images_arry={arrayOfArraysOfImageObjects} clicked={viewFullInfoMethod}/>
                        </div>
                    </div>
    }

    const availableProperty =   <div className={classes.AvailableProperty}>

                                    <div className={classes.AvailablePropertyBackgroundContent}>

                                            <div className={classes.AvailablePropertyHeader}>
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

        let displayAvailableProperty = null;

        let displayViewFullImagesInfo = null;

        if(viewFullInfo){
            displayViewFullImagesInfo = <ImageSlider slides={sliderData} clicked={viewFullInfoMethod}/>;
        }else{
            displayAvailableProperty = <div>
                                            {availableProperty}
                                            <DescriptionSection />
                                            <ContactUs />
                                       </div>;
        }

        return <div>
                   {displayViewFullImagesInfo}
                   {displayAvailableProperty}
               </div>;
}
export default AvailableProperty;