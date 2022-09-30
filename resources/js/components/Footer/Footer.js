import React, { useState, useEffect } from 'react';
import Grid from '@mui/material/Grid';
import Link from '@mui/material/Link';
import Image from 'react-bootstrap/Image';
import image_1 from '../../../images/frontend/rect_1.png';
import './Footer.scss';

function Footer(){
    const imageData = [
        {
            img: image_1,
            title: 'Bed',
        },
        {
            img: image_1,
            title: 'Bed',
        },
        {
            img: image_1,
            title: 'Bed',
        },
        {
            img: image_1,
            title: 'Bed',
        },
        {
            img: image_1,
            title: 'Bed',
        },
    ];
    return (
        <div className='footer'>
            <div className='footer-content'>
                <div className='footer-wrapper'>
                    <Grid container>
                        <Grid className='footer-list' item xs={4}>
                            <p>GET IN TOUCH</p>
                            <ul>
                                <li><Link href="#" >Contact us</Link></li>
                                <li><Link href="#" >Contact form</Link></li>
                                <li><Link href="#" >Frequently asked questions Manage</Link></li>
                                <li><Link href="#" >booking</Link></li>
                            </ul>
                        </Grid>
                        <Grid className='footer-list' item xs={4}>
                            <p>FOLLOW US</p>
                            <ul>
                                <li><Link href="#" >Newsletter</Link></li>
                                <li><Link href="#" >Mobile application</Link></li>
                                <li><Link href="#" >Blue Wings stories</Link></li>
                                <li><Link href="#" >Facebook</Link></li>
                                <li><Link href="#" >Instagram</Link></li>
                                <li><Link href="#" >Twitter</Link></li>
                                <li><Link href="#" >Youtube</Link></li>
                            </ul>
                        </Grid>
                        <Grid className='footer-list' item xs={4}>
                            <p>INSTRAGRAM</p>
                            <Grid container spacing={1}>
                                {imageData.map((item, index) => (
                                <Grid item xs={4} key={index}>
                                    <img className="" src={item.img} /> 
                                </Grid>
                                ))}
                            </Grid>
                        </Grid>
                    </Grid>
                </div>
            </div>
            <div className='footer-copyright'>

            </div>
        </div>
    );
}
export default Footer;