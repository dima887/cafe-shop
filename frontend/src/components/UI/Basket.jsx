import React from 'react';
import '../../styles/UI/Basket.css';
import Cookies from 'js-cookie';
import useBasketFunctions from "../../hooks/useBasketFunctions";
import usePaymentFunctions from "../../hooks/usePaymentFunctions";

const Basket = ({isOpen, onClose}) => {

    const { id, name, price, quantity, product, handleIncrementQuantity, handleDecrementQuantity, clearBasket } = useBasketFunctions();
    const { payment } = usePaymentFunctions();

    return (
        <div className={`basket-modal ${isOpen ? 'open' : ''}`}>
            <div className="basket-modal-content">
        <span className="close" onClick={onClose}>
          &times;
        </span>
                <div className="container">
                    <h1 className="header-basket">Shopping Cart</h1>

                    {!Cookies.get('basket') ? (
                        <div>
                            <h2 className="header-basket">Empty...</h2>
                        </div>
                    ) : (
                        <div>
                            {id.map((item, index) => (
                                <div key={index} className="cart-item">
                                    <div className="product-info">
                                        <h3>{name[index]}</h3>
                                        <p>Price: £{price[index]}</p>
                                    </div>
                                    <div className="product-actions">
                                        <button onClick={() => handleDecrementQuantity(id[index])}
                                                className="quantity-btn">-
                                        </button>
                                        <span className="quantity">{quantity[index]}</span>
                                        <button onClick={() => handleIncrementQuantity(id[index])}
                                                className="quantity-btn">+
                                        </button>
                                    </div>
                                </div>
                            ))}

                            <div className="total">Total: £{product.totalAmount}</div>

                            <div className="actions">
                                <button onClick={clearBasket} className="clear-btn">Clear Cart</button>
                                <button onClick={payment} className="pay-btn">Proceed to Payment</button>
                            </div>
                        </div>
                    )
                    }
                </div>

            </div>
        </div>
    );
};

export default Basket;
