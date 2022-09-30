import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { BrowserRouter, Route, Switch } from 'react-router-dom'
// import { Audio } from 'react-loader-spinner'
import store from '../store';
import './App.scss';
import HomePage from './HomePage/HomePage';
import Login from './Login/Login';
import Signup from './Signup/Signup';
import ForgotPassword from './ForgotPassword/ForgotPassword';

function App() {
    return (
        <Provider store={store}>
            <BrowserRouter>
                <Switch>
                    <Route exact path="/" component={HomePage}></Route>
                    <Route path="/signin" component={Login}></Route>
                    <Route path="/signup" component={Signup}></Route>
                    <Route path="/forgot-password" component={ForgotPassword}></Route>
                    {/* <AuthRoute path="/signin" component={SigninPage} />
                    <AuthRoute path="/forgotpass" component={ForgotPasswordPage} />
                    <AuthRoute path="/signup" component={SignupPage} />
                    <PrivateRoute path="/board" component={BoardPage} />
                    <PrivateRoute path="/tradinglog" component={TradingLogPage} />
                    <PrivateRoute path="/tradingbot" component={TradingBotPage} />
                    <PrivateRoute path="/marketmaker" component={MarketMaker} /> */}
                </Switch>
            </BrowserRouter>
        </Provider>
    );
}

export default App;
if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}