import classes from './DescriptionSection.module.css';
const DescriptionSection = () => {
    return <div className={classes.DescriptionSection}>
               <div>
                    <h1 className={classes.DescriptionSection__Header}>We can make our life easy</h1>
               </div>
               <div className={classes.DescriptionSection__underline}></div>
               <div className={classes.DescriptionSection__message}><p>We are playing a role to assist community in South 
               Africa to find the rooms to rent and to assist the landlords to find the tenance for the whole 9 
               provinces in South Africa, so what are you waiting for, unpload your room for free, because we can make it.</p></div>


            </div>;
}
export default DescriptionSection;