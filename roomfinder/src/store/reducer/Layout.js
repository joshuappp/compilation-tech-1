import * as actionTypes from '../action/actionTypes';

const initialState = {
    sideDrawerState: false,
    showDrawerToggleState: true,
    moveToHomeState: false
};

const sideDrawer = ( state, action ) => {
    return { ...state, sideDrawerState: action.sideDrawerState};
};
const showDrawerToggle = ( state, action ) => {
    return { ...state, showDrawerToggleState: action.showDrawerToggleState};
};
const moveToHomePage = ( state, action ) => {
    return { ...state, moveToHomeState: action.moveToHomeState};
};

const layout = ( state = initialState, action ) => {
    
    switch ( action.type ) {
        case actionTypes.SIDE_DRAWER_CONTROL: return sideDrawer(state, action);
        case actionTypes.SHOW_DRAWER_TOGGLE: return showDrawerToggle(state, action);
        case actionTypes.MOVE_TO_HOME_PAGE: return moveToHomePage(state, action);
        default:
            return state;
    }
};

export default layout;