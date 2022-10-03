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
import './Signup.scss';
import { sessionActions } from '../../store';

import { divide } from 'lodash';

function Signup(){
    const history = useHistory();
    const dispatch = useDispatch();

    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const [submitting, setSubmitting] = useState();
    const [error, setError] = useState();
    const [success, setSuccess] = useState();
    const handleNameChange = (event) => {
        setName(event.target.value);
    }

    const handleEmailChange = (event) => {
        setEmail(event.target.value);
    }

    const handlePasswordChange = (event) => {
        setPassword(event.target.value);
    }


    const handleRegister = async (e) => {
        e.preventDefault();
        const response = await fetch('/api/register', { method: 'POST', body: new URLSearchParams(`name=${name}&email=${email}&password=${password}`) });
        const res = await response.json();
        console.log(response);
        if (res.success) {
            setSuccess('Congratulations, your account has been successfully created.');
            dispatch(sessionActions.updateUser(res.data));
            // history.push('/signin');
        } else {
            setError(res.message);
        }
    }
    return (
        <>
            <Header/>
            <div className='signup'>
                <Grid container>
                    <Grid className='left-side' item xs={5}>
                        <div className='left-contents'>
                            <h3>You're new here!</h3>
                            <p>Sign up with your email and personal details to get started!</p>
                        </div>
                    </Grid>
                    <Grid className='right-side' item xs={7}>
                        <div className='right-contents d-grid'>
                            <h5 className="text-primary">Sign Up</h5>
                            {error && <Alert severity="error">{error}</Alert>}
                            {success && <Alert severity="success">{success}</Alert>}
                            <Form onSubmit={handleRegister}>
                            <Form.Group className="mb-3">
                                <Form.Label>Full Name</Form.Label>
                                <Form.Control type="text" placeholder="Enter Your Name" onChange={handleNameChange} />
                            </Form.Group>
                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label>Email address</Form.Label>
                                <Form.Control type="email" placeholder="Enter email" onChange={handleEmailChange} />
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control type="password" placeholder="Password" onChange={handlePasswordChange}/>
                            </Form.Group>
                            <Row>
                                <Col>
                                    <Button variant="primary" type="submit" className="mb-3 btn-block">
                                        Sign Up
                                    </Button>
                                </Col>
                            </Row>
                            <p className='text-center'>Already have an account? <Link to={"./signin"}>Sign In</Link></p>
                            </Form>
                        </div>
                    </Grid>
                </Grid>
            </div>
            <Footer/>
        </>
    );
}
export default Signup;