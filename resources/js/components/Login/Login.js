import React, { useState, useEffect } from 'react';
import Grid from '@mui/material/Grid';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { Link, useHistory } from 'react-router-dom';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col'
import Header from '../Header/Header';
import Footer from '../Footer/Footer';
import './Login.scss';

import { divide } from 'lodash';

function Login(){
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
                            <Form>
                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label>Email address</Form.Label>
                                <Form.Control type="email" placeholder="Enter email" />
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control type="password" placeholder="Password" />
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