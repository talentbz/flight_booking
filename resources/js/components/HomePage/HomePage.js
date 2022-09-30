import React, { useState, useEffect } from 'react';
import  BookingForm  from "../BookingForm/BookingForm";
import banner from '../../../images/frontend/bg_1.png';
import Divider from '@mui/material/Divider';
import Stack from '@mui/material/Stack';
import Image from 'react-bootstrap/Image';
import Grid from '@mui/material/Grid';
import Carousel from 'react-bootstrap/Carousel';
import Button from '@mui/material/Button';
import icon_1 from '../../../images/frontend/icon_1.png';
import icon_2 from '../../../images/frontend/icon_2.png';
import icon_3 from '../../../images/frontend/icon_3.png';
import slider_1 from '../../../images/frontend/slider_1.png';
import Header from '../Header/Header';
import Footer from '../Footer/Footer';
import './HomePage.scss';

import { divide } from 'lodash';

function HomePage(){
    const [index, setIndex] = useState(0);

    const handleSelect = (selectedIndex, e) => {
        setIndex(selectedIndex);
    };
    return (
        <>
            <Header/>
            <div className='banner'>
                <div className='search-bg'>
                    <div className='search-wrapper'>
                        <BookingForm />
                    </div>
                </div>
            </div>
            <div className='main-content'>
                <div className='about-us'>
                    <p className='welcome'>WELCOME TO</p>
                    <p className='company-name'>Numero un consultancy</p>
                    <p className='company-description'>Praesent eleifend sollicitudin lorem id fermentum. Sed finibus in felis rutrum vulputate. Sed vestibulum augue ut eros semper dictum. In eget urna egestas, luctus nisl eu.</p>
                    <Grid sx={{marginTop:5}} container>
                        <Grid className='item-list' item xs={4}>
                            <Image src={icon_1} />
                            <div className='list'>
                                <p className='list-title'>Over 100</p>
                                <p className='list-desc'>Destinations</p>
                            </div>
                        </Grid>
                        <Grid className='item-list' item xs={4}>
                            <Image src={icon_2} />
                            <div className='list'>
                                <p className='list-title'>Save Travel</p>
                                <p className='list-desc'>Numero Un Consultancy</p>
                            </div>
                        </Grid>
                        <Grid className='item-list' item xs={4}>
                            <Image src={icon_3} />
                            <div className='list'>
                                <p className='list-title'>Flexible Flight</p>
                                <p className='list-desc'>Tickets</p>
                            </div>
                        </Grid>
                    </Grid>
                </div>
                <div className='slider'>
                    <Carousel activeIndex={index} onSelect={handleSelect}>
                        <Carousel.Item>
                            <img
                            className="d-block w-100"
                            src={slider_1}
                            alt="First slide"
                            />
                            <Carousel.Caption>
                            <h3>First slide label</h3>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </Carousel.Caption>
                        </Carousel.Item>
                        <Carousel.Item>
                            <img
                            className="d-block w-100"
                            src={slider_1}
                            alt="Second slide"
                            />

                            <Carousel.Caption>
                            <h3>Second slide label</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </Carousel.Caption>
                        </Carousel.Item>
                        <Carousel.Item>
                            <img
                            className="d-block w-100"
                            src={slider_1}
                            alt="Third slide"
                            />

                            <Carousel.Caption>
                            <h3>Third slide label</h3>
                            <p>
                                Praesent commodo cursus magna, vel scelerisque nisl consectetur.
                            </p>
                            </Carousel.Caption>
                        </Carousel.Item>
                    </Carousel>
                </div>
                <div className='about-us'>
                    <p className='welcome'>USEFUL</p>
                    <p className='company-name'>INFORMATION</p>
                    <p className='company-description'>Quisque fringilla at metus et vehicula. Pellentesque sed dui ligula. Donec tempor lacus sed arcuiaculis egestas. Morbi dapibus volutpat interdum. Nulla nec ipsum lorem. </p>
                    <Button variant="contained" size="large">Book Now</Button>
                </div>
            </div>
            <Footer/>
        </>
    );
}
export default HomePage;