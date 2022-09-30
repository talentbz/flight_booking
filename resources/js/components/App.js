import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";

import store from '../store';
import './App.scss';
import HomePage from './HomePage/HomePage';

function App() {
    return (
        <Provider store={store}>
            <Router>
                    <Route path="/" component={HomePage}></Route>
                    {/* <AuthRoute path="/signin" component={SigninPage} />
                    <AuthRoute path="/forgotpass" component={ForgotPasswordPage} />
                    <AuthRoute path="/signup" component={SignupPage} />
                    <PrivateRoute path="/board" component={BoardPage} />
                    <PrivateRoute path="/tradinglog" component={TradingLogPage} />
                    <PrivateRoute path="/tradingbot" component={TradingBotPage} />
                    <PrivateRoute path="/marketmaker" component={MarketMaker} /> */}
            </Router>
        </Provider>
    );
}

export default App;
if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}