import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { BrowserRouter, Route, Switch } from 'react-router-dom'
// import { Audio } from 'react-loader-spinner'
import store from '../store';
import PrivateRoute from './PrivateRoute';
import AuthRoute from './AuthRoute';
import './App.scss';
import HomePage from './HomePage/HomePage';
import Login from './Login/Login';
import Signup from './Signup/Signup';
import ForgotPassword from './ForgotPassword/ForgotPassword';
import UserProfile from './User/Profile/Profile';

function App() {
    return (
        <Provider store={store}>
            <BrowserRouter>
                <Switch>
                    <Route exact path="/" component={HomePage}></Route>
                    {/* <Route path="/signin" component={Login}></Route>
                    <Route path="/signup" component={Signup}></Route>
                    <Route path="/forgot-password" component={ForgotPassword}></Route> */}
                    <Route path="/signin" component={Login} />
                    <Route path="/forgot-password" component={ForgotPassword} />
                    <Route path="/signup" component={Signup} />
                    <PrivateRoute path="/user-profile" component={UserProfile} />
                </Switch>
            </BrowserRouter>
        </Provider>
    );
}

export default App;
if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}