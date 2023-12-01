import React from 'react';
import '../../styles/UI/ModalPaymentSuccess.css';
import useBasketFunctions from "../../hooks/useBasketFunctions";

const ModalPaymentSuccess = ({ isOpen, onClose }) => {

    const { clearBasket } = useBasketFunctions();

    if (isOpen === true) {
        clearBasket();
    }

    return (
        <div className={`success-payment ${isOpen ? 'open' : ''}`}>
            <div className="modal-content">
        <span className="close" onClick={onClose}>
          &times;
        </span>
                <h2>Order has been paid</h2>

                <button className="success-payment-button">Go to orders</button>

            </div>
        </div>
    );
};

export default ModalPaymentSuccess;
