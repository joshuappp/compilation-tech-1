import * as actionTypes from '../action/actionTypes';

const initialState = {
    authenticated: false,
    username: '',
    userId: ''
};

const authentication = ( state, action ) => {
    return { ...state, authenticated: action.authState,username: action.username,userId: action.userId};
};

const auth = ( state = initialState, action ) => {
    
    switch ( action.type ) {
        case actionTypes.AUTHENTICATED: return authentication(state, action);
        default:
            return state;
    }
};

export default auth;