import React, { useState, useEffect } from 'react';
import { List, ListItemButton, ListItemIcon, ListItemText, Grid} from "@mui/material";
import { Link, useHistory } from 'react-router-dom';
import PermIdentityIcon from '@mui/icons-material/PermIdentity';
import FlightTakeoffIcon from '@mui/icons-material/FlightTakeoff';
import LogoutIcon from '@mui/icons-material/Logout';
import Avatar, { ConfigProvider } from 'react-avatar';

const Sidebar = (props) =>{
    return (
        <>
            <Grid item className='left-sidebar'>
                <Avatar className='avatar' name={props.userInfo.name} />
                <List component="nav" aria-labelledby="nested-list-subheader">
                    <ListItemButton component={Link} to="/user-profile">
                        <ListItemIcon>
                        <PermIdentityIcon />
                        </ListItemIcon>
                        <ListItemText primary="Profile" />
                    </ListItemButton>
                    <ListItemButton component={Link} to="/user-travel">
                        <ListItemIcon>
                        <FlightTakeoffIcon />
                        </ListItemIcon>
                        <ListItemText primary="Travellers" />
                    </ListItemButton>
                    <ListItemButton onClick={props.onLogout}>
                        <ListItemIcon>
                        <LogoutIcon />
                        </ListItemIcon>
                        <ListItemText primary="Logout" />
                    </ListItemButton>
                </List>
            </Grid>
        </>
    );
}
export default Sidebar;
