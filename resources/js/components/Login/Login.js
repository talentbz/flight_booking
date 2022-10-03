import React, { useState, useEffect } from 'react';
import { useDispatch } from 'react-redux';
import Grid from '@mui/material/Grid';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { Link, useHistory } from 'react-router-dom';
import Alert from '@mui/material/Alert';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col'
import Header from '../Header/Header';
import Footer from '../Footer/Footer';
import './Login.scss';
import { sessionActions } from '../../store';

import { divide } from 'lodash';

function Login(){
    let history = useHistory();
    const dispatch = useDispatch();

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState();
    const [success, setSuccess] = useState();

    const handleEmailChange = (event) => {
        setEmail(event.target.value);
    }

    const handlePasswordChange = (event) => {
        setPassword(event.target.value);
    }

    const handleLogin = async (e) => {
        if (e) e.preventDefault();
        const response = await fetch('/api/login', { method: 'POST', body: new URLSearchParams(`email=${email}&password=${password}`) });
        const res = await response.json();
        if (res.success) {
            setSuccess('success, You are successfully logged in');
            dispatch(sessionActions.updateUser(res.data));
            // history.push('/board');
        } else {
            setError(res.message);
        }
    }

    
    return (
        <>
            <Header/>
            <div className='login'>
                <Grid container>
                    <Grid className='left-side' item xs={5}>
                        <div className='left-contents'>
                            <h3>Welcome back!</h3>
                            <p>We are glad to see you again! Get access to your Orders, Wishlist and Recommendations.</p>
                        </div>
                    </Grid>
                    <Grid className='right-side' item xs={7}>
                        <div className='right-contents d-grid'>
                            <h5 className="text-primary">Log In</h5>
                            {error && <Alert severity="error">{error}</Alert>}
                            {success && <Alert severity="success">{success}</Alert>}
                            <Form onSubmit={handleLogin}>
                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label>Email address</Form.Label>
                                <Form.Control type="email" placeholder="Enter email" onChange={handleEmailChange} />
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control type="password" placeholder="Password" onChange={handlePasswordChange} />
                            </Form.Group>
                            <Row>
                                <Col xs={6}>
                                    <Form.Group className="mb-3" controlId="formBasicCheckbox">
                                        <Form.Check type="checkbox" label="Remember Me" />
                                    </Form.Group>
                                </Col>
                                <Col xs={6} className='text-right'>
                                    <Link to={"./forgot-password"}>Forgot Password?</Link>
                                </Col>
                            </Row>
                            <Row>
                                <Col>
                                    <Button variant="primary" type="submit" className="mb-3 btn-block">
                                        Log in
                                    </Button>
                                </Col>
                            </Row>
                            <p className='text-center'>Don't have an account? <Link to={"./signup"}>Sign Up</Link></p>
                            </Form>
                        </div>
                    </Grid>
                </Grid>
            </div>
            <Footer/>
        </>
    );
}
export default Login;