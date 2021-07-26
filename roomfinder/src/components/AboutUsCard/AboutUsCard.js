import classes from './AboutUsCard.module.css';
import ListOfCardsInfo from './ListOfCardsInfo/ListOfCardsInfo';
const AboutUsCard = (props) => {

    const cardHeader = props.cardInfo.header;
    const cardList = props.cardInfo.list;


     const listOfInfo = cardList.map((cardInfo,index) => {
            return <ListOfCardsInfo listOfCardsInfo={cardInfo} key={index}/>
     });

    return <div className={classes.AboutUsCard}>
               <div className={classes.AboutUsCardHeader}>
                        <h1>{cardHeader}</h1>
                </div>
                <div className={classes.AboutUsCardUnderline}></div>
                <div className={classes.AboutUsCardListWrapper}>
                    <ul>
                        {listOfInfo}
                    </ul>
                </div>
           </div>;
}
export default AboutUsCard;