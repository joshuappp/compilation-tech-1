import * as actionTypes from './actionTypes';

export const authentication = (the_authState,user,id) => {
    return {
           type: actionTypes.AUTHENTICATED,
           authState: the_authState,
           username: user,
           userId: id
        }
}
