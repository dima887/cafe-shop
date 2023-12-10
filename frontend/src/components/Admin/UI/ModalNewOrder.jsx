import React from 'react';
import '../../../styles/Admin/UI/ModalNewOrder.css';

const ModalNewOrder = ({ isOpen, onClose }) => {


    return (
        <div className={`success-payment ${isOpen ? 'open' : ''}`}>
            <div className="modal-content">
        <span className="close" onClick={onClose}>
          &times;
        </span>
                <h2>New order has arrived!</h2>

                <button className="success-payment-button" onClick={onClose}>Ok</button>

            </div>
        </div>
    );
};

export default ModalNewOrder;
