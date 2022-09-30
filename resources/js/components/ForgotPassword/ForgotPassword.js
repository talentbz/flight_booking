import React, { useState, useEffect } from 'react';
import Grid from '@mui/material/Grid';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { Link, useHistory } from 'react-router-dom';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col'
import Header from '../Header/Header';
import Footer from '../Footer/Footer';
import './ForgotPassword.scss';

import { divide } from 'lodash';

function ForgotPassword(){
    return (
        <>
            <Header/>
            <div className='forgot-password'>
                <Grid container>
                    <Grid className='left-side' item xs={5}>
                        <div className='left-contents'>
                            <h3>Don't worry,</h3>
                            <p>We are here help you to recover your password.</p>
                        </div>
                    </Grid>
                    <Grid className='right-side' item xs={7}>
                        <div className='right-contents d-grid'>
                            <h5 className="text-primary">Forgot your Password?</h5>
                            <Form>
                            <Form.Group className="mb-3">
                                <Form.Label>Enter the email address</Form.Label>
                                <Form.Control type="email" placeholder="Enter Your Email" />
                            </Form.Group>
                            <Row>
                                <Col>
                                    <Button variant="primary" type="submit" className="mb-3 btn-block">
                                        Continue
                                    </Button>
                                </Col>
                            </Row>
                            <p className='text-center'>Return to <Link to={"./signin"}>Sign In</Link></p>
                            </Form>
                        </div>
                    </Grid>
                </Grid>
            </div>
            <Footer/>
        </>
    );
}
export default ForgotPassword;