import React, { useState, useEffect } from 'react';
import { Link, useHistory } from 'react-router-dom';
import List from '@mui/material/List';
import ListItemButton from '@mui/material/ListItemButton';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import PermIdentityIcon from '@mui/icons-material/PermIdentity';
import LoginIcon from '@mui/icons-material/Login';
import FlightTakeoffIcon from '@mui/icons-material/FlightTakeoff';
import LogoutIcon from '@mui/icons-material/Logout';
import Avatar from '@mui/material/Avatar';
import Grid from '@mui/material/Grid';
import Header from '../../Header/Header';
import Footer from '../../Footer/Footer';
import './Profile.scss';

function Profile(){
    return (
        <>
            <Header/>
            <div className='contents-wrapper'>
                <div className='main-contents'>
                    <Grid container>
                        <Grid item className='left-sidebar'>
                            <Avatar className='avatar' variant="rounded">
                                U3
                            </Avatar>
                            <List component="nav" aria-labelledby="nested-list-subheader">
                                <ListItemButton>
                                    <ListItemIcon>
                                    <PermIdentityIcon />
                                    </ListItemIcon>
                                    <ListItemText primary="Profile" />
                                </ListItemButton>
                                <ListItemButton>
                                    <ListItemIcon>
                                    <LoginIcon />
                                    </ListItemIcon>
                                    <ListItemText primary="Login Details" />
                                </ListItemButton>
                                <ListItemButton>
                                    <ListItemIcon>
                                    <FlightTakeoffIcon />
                                    </ListItemIcon>
                                    <ListItemText primary="Travellers" />
                                </ListItemButton>
                                <ListItemButton>
                                    <ListItemIcon>
                                    <LogoutIcon />
                                    </ListItemIcon>
                                    <ListItemText primary="Logout" />
                                </ListItemButton>
                            </List>
                        </Grid>
                        <Grid item className='right-sidebar'>
                            xs=4
                        </Grid>
                    </Grid>
                </div>
            </div>
            <Footer/>
        </>
    );
}
export default Profile;