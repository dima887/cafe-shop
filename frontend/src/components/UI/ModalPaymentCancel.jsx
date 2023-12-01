import React from 'react';
import '../../styles/UI/ModalPaymentCancel.css';

const ModalPaymentCancel = ({ isOpen, onClose }) => {

    return (
        <div className={`cancel-payment ${isOpen ? 'open' : ''}`}>
            <div className="modal-content">
        <span className="close" onClick={onClose}>
          &times;
        </span>
                <h2>Order cancelled</h2>

            </div>
        </div>
    );
};

export default ModalPaymentCancel;
