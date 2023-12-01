import React, {useEffect, useState} from 'react';
import {Link, useHistory, useLocation} from 'react-router-dom';
import '../../styles/UI/Navbar.css';
import Basket from "./Basket";
import ModalPaymentCancel from "./ModalPaymentCancel";
import ModalPaymentSuccess from "./ModalPaymentSuccess";

const Navbar = () => {
    const [menuOpen, setMenuOpen] = useState(false);
    const [isBasketModel, setIsBasketModel] = useState(false);
    const [cancelPaymentModal, setCancelPaymentModal] = useState(false);
    const [successPaymentModal, setSuccessPaymentModal] = useState(false);
    const location = useLocation();
    const history = useHistory();

    useEffect(() => {
        if (location.search === '?payment=false') {
            setCancelPaymentModal(true)
        }

        if (location.search === '?payment=true') {
            setSuccessPaymentModal(true)
        }
    }, [location.search])

    const toggleMenu = () => {
        setMenuOpen(!menuOpen);
    };

    const isOpen = () => {
        setIsBasketModel(!isBasketModel);
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
                        <span onClick={isOpen} className="nav-links pointer">
                            Basket
                        </span>
                        </li>
                    </ul>
                </div>
            </nav>

            <Basket
                isOpen={isBasketModel}
                onClose={isOpen}
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