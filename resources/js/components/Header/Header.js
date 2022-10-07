import React, { useState, useEffect } from 'react';
import { Link, useHistory } from 'react-router-dom';
import Image from 'react-bootstrap/Image';
import logo from '../../../images/frontend/logo.png';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import Avatar, { ConfigProvider } from 'react-avatar';
import Dropdown from 'react-bootstrap/Dropdown';
import { useSelector, useDispatch } from 'react-redux';
import { sessionActions } from '../../store';
import LogoutIcon from '@mui/icons-material/Logout';
import './Header.scss';

function Header(){
    const history = useHistory();
    const dispatch = useDispatch();
    const onLogout = (e) =>{
        dispatch(sessionActions.updateUser(null));
        history.push('/signin');
    }
    const user = useSelector(state => state.session.user);
    return (
        <div className='header'>
            <div className='menu'>
                <Link to={"/"}><Image className="logo" src={logo} /></Link>
                <div className="user-avatar">
                    {!user ? (
                        <Link to={"/signin"}><AccountCircleIcon sx={{ fontSize: 45}}/><span>LOG IN</span></Link>
                    ) : (
                        <Dropdown>
                            <Dropdown.Toggle className='avatar-image'>
                                {!user.avatar ? (
                                    <ConfigProvider colors={['red', 'green', 'blue']}>
                                        <Avatar name={user.name} size="50" round={true} />    
                                    </ConfigProvider>
                                ) : (
                                    <img src='/images/logo.png' />
                                )}
                            </Dropdown.Toggle>
                            <Dropdown.Menu>
                                <Dropdown.Item href="/user-profile">My Page</Dropdown.Item>
                                <Dropdown.Item href="/">Another action</Dropdown.Item>
                                <Dropdown.Item onClick={onLogout}><LogoutIcon />Log out</Dropdown.Item>
                            </Dropdown.Menu>
                        </Dropdown>
                    )}
                </div>
            </div>
        </div>
    );
}
export default Header;