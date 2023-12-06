import React, {useEffect, useState} from 'react';
import { Link } from 'react-router-dom';
import '../../../styles/UI/Navbar.css';
import useAuthFunctions from "../../../hooks/useAuthFunctions";
import {useSelector} from "react-redux";

const Navbar = () => {
    const [menuOpen, setMenuOpen] = useState(false);
    const { getAuthUser } = useAuthFunctions();
    const user = useSelector((state) => state.user);

    useEffect(() => {
        getAuthUser();
    })

    const toggleMenu = () => {
        setMenuOpen(!menuOpen);
    };

    return (
        <nav className="navbar">
            <div className="navbar-container">
                <Link to="/" className="navbar-logo">
                    CafeApp
                </Link>
                <div className="menu-icon" onClick={toggleMenu}>
                    ☰
                </div>
                <ul className={menuOpen ? "nav-menu active" : "nav-menu"}>
                    <li className="nav-item">
                        <Link to="/admin/category" className="nav-links">
                            Category
                        </Link>
                    </li>
                    <li className="nav-item">
                        <Link to="/admin/product" className="nav-links">
                            Product
                        </Link>
                    </li>
                    <li className="nav-item">
                        <Link to="/admin/news" className="nav-links">
                            News
                        </Link>
                    </li>
                    {!user.user ? '' : (
                        <li className="nav-item">
                            <span className="nav-links pointer">
                                {user.user.name}
                            </span>
                        </li>
                    )}
                </ul>
            </div>
        </nav>
    );
};

export default Navbar;