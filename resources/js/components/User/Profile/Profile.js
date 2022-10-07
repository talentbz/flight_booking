import React, { useState, useEffect } from 'react';
import { List, ListItemButton, ListItemIcon, ListItemText, Grid} from "@mui/material";
import { Link, useHistory } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';
import {Form, Row, Col, Container, Button} from 'react-bootstrap';
import Header from '../../Header/Header';
import Sidebar from '../Sidebar';
import Footer from '../../Footer/Footer';
import ImageAvatar from './ImageAvatar';
import './Profile.scss';
import SeatPicker from '../../SeatPicker';
import { sessionActions } from '../../../store';

function Profile(){
    let history = useHistory();
    const dispatch = useDispatch();
    const user = useSelector(state => state.session.user);
    const [newAvatar, setNewAvatar] = useState(user.avatar);
    const [email, setEmail] = useState(user.email);
    const [name, setName] = useState(user.name);
    const [phone, setPhone] = useState(user.phone);
    const [address, setAddress] = useState('');
    const onLogout = (e) =>{
        dispatch(sessionActions.updateUser(null));
        history.push('/signin');
    }
    const handleAvatarChange = (file) => {
        setNewAvatar(file);
    };
    const handleEmailChange = (event) => {
        setEmail(event.target.value);
    }
    const handleUserName = (event) => {
        setName(event.target.value);
    }
    const handlePhoneChange = (event) => {
        setPhone(event.target.value);
    }
    const handleAddress = (event) => {  
        setAddress(event.target.value);
    }
    const handleUpdate = async (e) => {
        if (e) e.preventDefault();
        // const response = await fetch('/api/user-store', { method: 'POST', body: new URLSearchParams(`email=${email}&avatar=${newAvatar}&name=${name}&phone=${phone}&address=${address}`) });
        const response = await fetch('/api/paystack/pay', { method: 'POST', body: new URLSearchParams(`email=${email}&avatar=${newAvatar}&name=${name}&phone=${phone}&address=${address}`) });
        const res = await response.json();
        if (res.success) {
            setSuccess('success, You are successfully logged in');
            dispatch(sessionActions.updateUser(res.data));
        } else {
            setError(res.message);
        }
    }
    const rows = [
        [
          { id: 1, number: "1" },
          { id: 2, number: "2" },
          null,
          { id: 3, number: "3", isReserved: true, tooltip: "Reserved" },
          { id: 4, number: "4" }
        ],
        [
          { id: 5, number: "1" },
          { id: 6, number: "2" },
          null,
  
          { id: 7, number: "3" },
          { id: 8, number: "4" }
        ],
        [
          { id: 9, number: "1", isReserved: true, tooltip: "Reserved" },
          { id: 10, number: "2" },
          null,
  
          { id: 11, number: "3" },
          { id: 12, number: "4" }
        ],
        [
          { id: 13, number: "1" },
          { id: 14, number: "2" },
          null,
  
          { id: 15, number: "3" },
          { id: 16, number: "4" }
        ],
        [
          { id: 17, number: "1" },
          { id: 28, number: "2" },
          null,
          { id: 19, number: "3", isReserved: true, tooltip: "Reserved" },
          { id: 20, number: "4", isReserved: true, tooltip: "Reserved" }
        ],
        [
          { id: 21, number: "1", isReserved: true, tooltip: "Reserved" },
          { id: 22, number: "2" },
          null,
  
          { id: 23, number: "3" },
          { id: 24, number: "4" }
        ],
        [
          { id: 25, number: "1" },
          { id: 26, number: "2" },
          null,
  
          { id: 27, number: "3" },
          { id: 28, number: "4" }
        ]
      ];
    return (
        <>
            <Header/>
            <div className='contents-wrapper'>
                <div className='main-contents'>
                    <Grid container>
                        <Sidebar userInfo={user} onLogout={onLogout}/>
                        <Grid item className='right-sidebar'>
                            <Form onSubmit={handleUpdate}>
                                <div className="picture-container">
                                    <ImageAvatar onChange={handleAvatarChange}/>
                                </div>
                                <Container>
                                    <Row>
                                        <Col>
                                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                                <Form.Label>User Name</Form.Label>
                                                <Form.Control type="text" placeholder="Enter User Name" value={user.name} onChange={handleUserName} />
                                            </Form.Group>
                                        </Col>
                                        <Col>
                                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                                <Form.Label>Email address</Form.Label>
                                                <Form.Control type="email" placeholder="Enter email" value={user.email} onChange={handleEmailChange} />
                                            </Form.Group>
                                        </Col>
                                    </Row>
                                    <Row>
                                        <Col>
                                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                                <Form.Label>Phone Number</Form.Label>
                                                <Form.Control type="number" placeholder="Enter Phone Number" value={user.phone}  onChange={handlePhoneChange} />
                                            </Form.Group>
                                        </Col>
                                        <Col>
                                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                                <Form.Label>Address</Form.Label>
                                                <Form.Control type="text" placeholder="Enter Address" onChange={handleAddress} />
                                            </Form.Group>
                                        </Col>
                                    </Row>
                                    <Row>
                                        <Col>
                                            <Button variant="primary" type="submit" className="mb-3 btn-block">
                                                Save
                                            </Button>
                                        </Col>
                                    </Row>
                                </Container>
                            </Form>
                            <SeatPicker
                            // addSeatCallback={this.addSeatCallback}
                            // removeSeatCallback={this.removeSeatCallback}
                            rows={rows}
                            maxReservableSeats={4}
                            alpha
                            visible
                            selectedByDefault
                            // loading={loading}
                            tooltipProps={{ multiline: true }}
                        />
                        </Grid>
                    </Grid>
                </div>
            </div>
            <Footer/>
        </>
    );
}
export default Profile;
