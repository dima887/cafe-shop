import React from 'react';
import '../../styles/UI/UserNav.css';
import {Link} from "react-router-dom";

const UserNav = () => {

    return (
        <div className="container-user-nav">
            <button className="button-user-nav">
                <Link to="/user/profile" className="nav-links">Profile</Link>
            </button>
            <button className="button-user-nav">
                <Link to="/user/order" className="nav-links">Order</Link>
            </button>

        </div>
    );
};

export default UserNav;