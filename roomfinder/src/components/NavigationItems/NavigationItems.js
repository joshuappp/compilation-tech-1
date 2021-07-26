import NavigationItem from './NavigationItem/NavigationItem';
import classes from './NavigationItems.module.css';
const navigationItems = (props) => <ul className={classes.NavigationItems}>
                                   <NavigationItem link="/" exact closeSideDrawer={props.clicked}>Find Property</NavigationItem>
                                   <NavigationItem link="upload_property" exact closeSideDrawer={props.clicked}>Upload Property</NavigationItem>
                                   <NavigationItem link="available_property" exact closeSideDrawer={props.clicked}>Available Property</NavigationItem>
                                   <NavigationItem link="delete_property" exact closeSideDrawer={props.clicked}>Delete Property</NavigationItem>
                                   <NavigationItem link="about_us"exact closeSideDrawer={props.clicked}>About Us</NavigationItem>
                              </ul>

export default navigationItems;