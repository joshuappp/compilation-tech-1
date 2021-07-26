import classes from './AboutUs.module.css';
import AboutUsCard from '../../components/AboutUsCard/AboutUsCard';
import DescriptionSection from '../../components/DescriptionSection/DescriptionSection';
import ContactUs from '../../components/ContactUs/ContactUs';
const AboutUs = () => {

    const aboutUsCardInfo = [
                             {"header":"WHY WE ENVOLVE AS COMPILATION TECH",
                             "list": ["We Play A Role To Make The Life More Simple With Tech"]
                             },
                             {"header":"BENEFITS OF USING ROOMFINDER",
                             "list": ["There Is No Charge To Upload Your Room",
                             "The Is No Charge To Look For The Room",
                             "We Made It, To Be Simple And Straight Forward To Use"]
                             }
                            ];


    const aboutUs = <div>

            <div className={classes.AboutUs}>
                            <div className={classes.AboutUsBackgroundContent}>
                                <AboutUsCard cardInfo={aboutUsCardInfo[0]}/>
                                <AboutUsCard cardInfo={aboutUsCardInfo[1]}/>
                            </div>
                            
                    </div>

             
        </div>;

    return <div>
               {aboutUs}
               <DescriptionSection />
               <ContactUs />
           </div>;
}
export default AboutUs;