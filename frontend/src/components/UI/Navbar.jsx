import React, {useEffect, useState} from 'react';
import {Link, useHistory, useLocation} from 'react-router-dom';
import '../../styles/UI/Navbar.css';
import Basket from "./Basket";
import ModalPaymentCancel from "./ModalPaymentCancel";
import ModalPaymentSuccess from "./ModalPaymentSuccess";
import {useSelector} from "react-redux";
import useAuthFunctions from "../../hooks/useAuthFunctions";

const Navbar = () => {
    const [menuOpen, setMenuOpen] = useState(false);
    const [isBasketModal, setIsBasketModal] = useState(false);
    const [cancelPaymentModal, setCancelPaymentModal] = useState(false);
    const [successPaymentModal, setSuccessPaymentModal] = useState(false);
    const location = useLocation();
    const history = useHistory();
    const user = useSelector((state) => state.user);
    const { handleLogout } = useAuthFunctions();

    useEffect(() => {
        if (location.search === '?payment=false') {
            setCancelPaymentModal(true)
        }

        if (location.search === '?payment=true') {
            setSuccessPaymentModal(true)
        }

    }, [location.search]);

    const toggleMenu = () => {
        setMenuOpen(!menuOpen);
    };

    const isOpenBasket = () => {
        setIsBasketModal(!isBasketModal);
    };

    const CloseCancelPaymentModal = () => {
        history.replace({ ...history.location, search: '' });
        setCancelPaymentModal(false)
    }

    const CloseSuccessPaymentModal = () => {
        history.replace({ ...history.location, search: '' });
        setSuccessPaymentModal(false)
    }

    return (
        <div>
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
                        <li className="nav-item">
                            <span onClick={isOpenBasket} className="nav-links pointer">
                                Basket
                            </span>
                        </li>

                        {user.user ? '' : (
                            <li className="nav-item">
                                <Link to="/login" className="nav-links">
                                    Login
                                </Link>
                            </li>
                        )}
                        {user.user ? '' : (
                            <li className="nav-item">
                                <Link to="/register" className="nav-links">
                                    Register
                                </Link>
                            </li>
                        )}
                        {!user.user ? '' : (
                            <li className="nav-item">
                                <Link to="/user/profile" className="nav-links pointer">
                                    {user.user.name}
                                </Link>
                            </li>
                        )}
                        {(!user.user || 'admin' !== user.user.role) ? '' : (
                            <li className="nav-item">
                                <Link to="/admin/category" className="nav-links">
                                    Admin Panel
                                </Link>
                            </li>
                        )}
                        {!user.user ? '' : (
                            <li className="nav-item">
                                <span onClick={handleLogout} className="nav-links pointer">
                                    Logout
                                </span>
                            </li>
                        )}

                    </ul>
                </div>
            </nav>

            <Basket
                isOpen={isBasketModal}
                onClose={isOpenBasket}
            />

            <ModalPaymentCancel
                isOpen={cancelPaymentModal}
                onClose={CloseCancelPaymentModal}
            />

            <ModalPaymentSuccess
                isOpen={successPaymentModal}
                onClose={CloseSuccessPaymentModal}
            />
        </div>
    );
};

export default Navbar;