import classes from './ListOfCardsInfo.module.css';
const ListOfCardsInfo = (props) => {
     return <li className={classes.ListOfCardsInfo}><p>{props.listOfCardsInfo}</p></li>;
}
export default ListOfCardsInfo;