import { NavLink } from 'react-router-dom';
import classes from './NavigationItem.module.css';
const navigationItem = (props) => <li className={classes.NavigationItem}>
                                 <NavLink
                                    to={props.link}
                                    exact={props.exact}
                                    onClick={props.closeSideDrawer}
                                 >
                                 {props.children}
                                 </NavLink>
                                 
                             </li>

export default navigationItem;