import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import '../../styles/UI/Navbar.css';

const Navbar = () => {
    const [menuOpen, setMenuOpen] = useState(false);

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
                        <Link to="/" className="nav-links">
                            Home
                        </Link>
                    </li>
                    <li className="nav-item">
                        <Link to="/menu" className="nav-links">
                            Menu
                        </Link>
                    </li>
                    <li className="nav-item">
                        <Link to="/news" className="nav-links">
                            News
                        </Link>
                    </li>
                    <li className="nav-item">
                        <Link to="/about" className="nav-links">
                            About
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>
    );
};

export default Navbar;