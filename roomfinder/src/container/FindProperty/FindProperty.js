import classes from './FindProperty.module.css';
import DescriptionSection from '../../components/DescriptionSection/DescriptionSection';
import ContactUs from '../../components/ContactUs/ContactUs';
import { useState } from 'react';
const FindProperty = () => {

    const [formData,setFormData] = useState({province: "",location: "",section: ""});
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


    }


    let homeSection = <div className={classes.FindProperty}>
                <div className={classes.FindPropertyBackgroundContent}>

                    <div className={classes.FindPropertyHeader}>
                        <h1>FIND ROOM TO RENT IN SA</h1>
                    </div>
                    <div className={classes.FindPropertyUnderline}></div>
                    <div className={classes.FindPropertyFormCotainer}>
                            <form onSubmit={formHandler} className={classes.FindPropertyForm}>

                                    <label htmlFor="province">Province*</label>
                                    <select id="province">
                                        <option value="gauteng">Gauteng</option>
                                        <option value="north-west">North West</option>
                                        <option value="mpumalanga">Mpumalanga</option>
                                        <option value="kwazulu-natal">Kwazulu Natal</option>
                                        <option value="western-cape">Western Cape</option>
                                        <option value="limpopo">Limpopo</option>
                                        <option value="northen-cape">Northen Cape</option>
                                        <option value="free-state">Free State</option>
                                        <option value="eastern-cape">Eastern Cape</option>
                                    </select>
                                    <label htmlFor="location">Location*</label>
                                    <input type="text" name="location" placeholder="e.g Soweto" value={formData.name} onChange={event => inputChangedHandler(event,"location")} required maxLength="30"/>
                                    <label htmlFor="section">Section*</label>
                                    <input type="text" name="section" placeholder="e.g Pimville" value={formData.name} onChange={event => inputChangedHandler(event,"section")} required maxLength="30"/>
                                    <button>FIND</button>
                            </form>
                    </div>
                    
              </div>
              

           </div>;

    return <div>
               {homeSection}
               <DescriptionSection />
               <ContactUs />
          </div>;
}
export default FindProperty;