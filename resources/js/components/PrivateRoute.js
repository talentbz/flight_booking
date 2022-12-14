// This is used to determine if a user is authenticated and
// if they are allowed to visit the page they navigated to.

// If they are: they proceed to the page
// If not: they are redirected to the login page.
import React from 'react';
import { Redirect, Route } from 'react-router-dom';
import { useSelector } from 'react-redux';

const PrivateRoute = ({ component: Component, ...rest }) => {
    const user = useSelector(state => state.session.user); 
    return (
        <Route
            {...rest}
            render={props =>
                user != null ? (
                    <Component {...props} />
                ) : (
                    <Redirect to={{ pathname: '/signin', state: { from: props.location } }} />
                )
            }
        />
    )
}

export default PrivateRoute