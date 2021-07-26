import classes from './AvailablePropertyImageCard.module.css';
const AvailablePropertyImageCard = (props) => {

    let deletePropertyButton = null;
    if(props.deleteProperty === "display"){
        deletePropertyButton = <button onClick={() => props.clickedDelete(props.the_images_arry[0][0].id)}>Delete Room</button>;
    }
    
    

    return props.the_images_arry.map((imageArray,index) => {
        let the_address = imageArray[0].address;
        let whiten_address1 = '';
        let whiten_address2 = '';
        let whiten_address3 = '';
        let whiten_address4 = '';
        if(the_address.length > 19){
            the_address = imageArray[0].address.substring(0,15);
            whiten_address1 = imageArray[0].address.substring(15,16);
            whiten_address2 = imageArray[0].address.substring(16,17);
            whiten_address3 = imageArray[0].address.substring(17,18);
            whiten_address4 = imageArray[0].address.substring(18,19);
        }

        return <div className={classes.AvailablePropertyImageCard} key={index}>
                    <div className={classes.AvailablePropertyImageCardFunctions}>
                        <div>
                             <button onClick={() => props.clicked(imageArray[0].id)}>View Full Info</button>
                        </div>
                        <div>
                             {deletePropertyButton}
                        </div>
                    </div>
                    <div className={classes.AvailablePropertyImageCardInfo}>
                        <h3>Address:  {the_address}<span className={classes.whitenAddress1}>{whiten_address1}</span>
                        <span className={classes.whitenAddress2}>{whiten_address2}</span>
                        <span className={classes.whitenAddress3}>{whiten_address3}</span>
                        <span className={classes.whitenAddress4}>{whiten_address4}</span>
                        </h3>
                        <h3>Price: R{imageArray[0].price}</h3>
                        <h3>Contact: {imageArray[0].contact}</h3>
                    </div>
                    <div className={classes.AvailablePropertyImageCardImage} onClick={() => props.clicked(imageArray[0].id)}>
                         <img src={imageArray[0].imageUrl} alt=""/>
                    </div>
                    
                </div>;
    });
}
export default AvailablePropertyImageCard;