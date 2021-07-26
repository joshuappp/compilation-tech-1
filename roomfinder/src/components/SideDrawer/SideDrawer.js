import React, { useEffect } from 'react';
import { Redirect } from 'react-router-dom';
import classes from './SideDrawer.module.css';
import Logo from '../Logo/Logo';
import NavigationItems from '../NavigationItems/NavigationItems';
import { useDispatch, useSelector } from 'react-redux';
import * as actions from '../../store/action/index';

const SideDrawer = () => {
    const dispatch = useDispatch();

    const sideDrawerState = useSelector(state=> {
        return state.layout.sideDrawerState;
    });

    const moveToHome = useSelector(state => {
        return state.layout.moveToHomeState;
    });

    const navigateToHomePage = () => {
        dispatch(actions.showSideDrawer(false));
        dispatch(actions.showDrawerToggle(true));
        dispatch(actions.moveToHomePage(true));
    }

    const closeSideDrawerMethod = () => {
        dispatch(actions.showSideDrawer(false));
        dispatch(actions.showDrawerToggle(true));
    }

    let home = null;
    if(moveToHome){
      home  = <Redirect to="/" />
    }

    useEffect(()=>{
        dispatch(actions.moveToHomePage(false));
     },[moveToHome,dispatch]);

    let sideDrawer = null;

    if(sideDrawerState){
        sideDrawer = <div className={classes.SideDrawer}>
                        {home}
                        <div>
                            <Logo clicked={navigateToHomePage}/>
                        </div>
                        <div>
                            <NavigationItems clicked={closeSideDrawerMethod}/>
                        </div>
                        
                    </div>
    }

    return <div>{sideDrawer}</div>;
} 
  
export default SideDrawer;