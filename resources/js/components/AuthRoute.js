// This is used to determine if a user is authenticated and
// if they are allowed to visit the page they navigated to.

// If they are: they proceed to the page
// If not: they are redirected to the login page.
import React from 'react';
import { Redirect, Route } from 'react-router-dom';
import { useSelector } from 'react-redux';

const AuthRoute = ({ component: Component, ...rest }) => {
    const user = useSelector(state => state.session.user); 

    return (
        <Route
            {...rest}
            render={props =>
                user != null ? (
                    <Redirect to={{ pathname: '/', state: { from: props.location } }} />
                ) : (
                    <Component {...props} />
                )
            }
        />
    )
}

export default AuthRoute