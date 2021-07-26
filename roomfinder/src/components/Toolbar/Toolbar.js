import React, { useEffect } from 'react';
import { Redirect } from 'react-router-dom';
import classes from './Toolbar.module.css';
import Logo from '../Logo/Logo';
import Backdrop from '../Backdrop/Backdrop';
import ToggleButton from '../ToggleButton/ToggleButton';
import NavigationItems from '../NavigationItems/NavigationItems';
import { useDispatch, useSelector } from 'react-redux';
import * as actions from '../../store/action/index';

const Toolbar = () => {

    const dispatch = useDispatch();
    const showDrawerToggleState = useSelector(state => {
       return state.layout.showDrawerToggleState;
    });
    const showSideDrawerState = useSelector(state => {
        return state.layout.sideDrawerState;
     });

     const moveToHome = useSelector(state => {
         return state.layout.moveToHomeState;
     });

    const showSideDrawerMethod = () => {
       dispatch(actions.showDrawerToggle(false));
       dispatch(actions.showSideDrawer(true));
    }
    const hideSideDrawerMethod = () => {
        dispatch(actions.showDrawerToggle(true));
        dispatch(actions.showSideDrawer(false));
     } 
      
     const navigateToHomePage = () => {
         dispatch(actions.moveToHomePage(true));
     }
    
    let drawerToggle = null;
    let backdrop = null;
 
    if(showDrawerToggleState){
       drawerToggle  = <ToggleButton clicked={showSideDrawerMethod} />
       
    }
    if(showSideDrawerState){
        backdrop  = <Backdrop clicked={hideSideDrawerMethod} />
    }
    let home = null;
    if(moveToHome){
      home  = <Redirect to="/" />
    }

    useEffect(()=>{
      dispatch(actions.moveToHomePage(false));
   },[moveToHome,dispatch]);

    
    return <header className={classes.MainHeader}>
            {home}
            {backdrop}
             <div className={classes.Toolbar}>
                <div>
                    <Logo clicked={navigateToHomePage}/>
                </div>
                <div className={classes.MobileOnly}>
                   {drawerToggle}
                </div>
                <div className={classes.DesktopOnly}>
                    <NavigationItems /> 
                </div>
             </div>
          </header>;
                    
 }
 
 export default Toolbar;