import React, { useState, useEffect } from 'react';
import { Link, useHistory } from 'react-router-dom';
import Image from 'react-bootstrap/Image';
import logo from '../../../images/frontend/logo.png';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import './Header.scss';

function Header(){
    return (
        <div className='header'>
            <div className='menu'>
                <Image className="logo" src={logo} />
                <div className="user-avatar">
                    <Link to="#"><AccountCircleIcon /><span>LOG IN</span></Link>
                </div>
            </div>
        </div>
    );
}
export default Header;