import React, { useState, useEffect } from 'react';
import Grid from '@mui/material/Grid';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { Link, useHistory } from 'react-router-dom';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col'
import Header from '../Header/Header';
import Footer from '../Footer/Footer';
import './Signup.scss';

import { divide } from 'lodash';

function Signup(){
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
                            <Form>
                            <Form.Group className="mb-3">
                                <Form.Label>Full Name</Form.Label>
                                <Form.Control type="text" placeholder="Enter Your Name" />
                            </Form.Group>
                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label>Email address</Form.Label>
                                <Form.Control type="email" placeholder="Enter email" />
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control type="password" placeholder="Password" />
                            </Form.Group>
                            {/* <Row>
                                <Col xs={6}>
                                    <Form.Group className="mb-3" controlId="formBasicCheckbox">
                                        <Form.Check type="checkbox" label="Remember Me" />
                                    </Form.Group>
                                </Col>
                                <Col xs={6} className='text-right'>
                                    <Link to={"./forgot-password"}>Forgot Password?</Link>
                                </Col>
                            </Row> */}
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