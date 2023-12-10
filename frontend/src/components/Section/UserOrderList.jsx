import React from 'react';
import '../../styles/Admin/Section/CategoryList.css';

const UserOrderList = ({ orders }) => {
    return (
        <div className="order-list-container">
            <h2 className="order-list-heading">My Order List</h2>
            {orders.length === 0 ? (
                <p className="order-list-empty">No orders available.</p>
            ) : (
                <div className="order-list-items">
                    {orders.map((order) => (
                        <div key={order.id} className="order-item">
                            <div className="order-info">
                                <p className="order-id">Order ID: {order.id}</p>
                                <p className="order-date">Date: {order.created_at}</p>
                            </div>
                            <hr/>
                            <div className="order-products">
                                <h5 className="order-products-heading">Products:</h5>
                                <ul className="order-products-list">
                                    <li key={order.product.id} className="order-product">
                                        {order.product.name} - Quantity: {order.product.id}
                                    </li>
                                </ul>
                            </div>
                            <hr/>
                            <div className="order-products">
                                <h5 className="order-products-heading">User: {order.user.name}</h5>
                            </div>
                            <hr/>
                            <div className="order-products">
                                <h5 className="order-products-heading">Type order: {order.type_order.type}</h5>
                            </div>
                            <hr/>
                            <div className="order-products">
                                <h5 className="order-products-heading">Status order: {order.status_order.status_order}</h5>
                            </div>
                            <hr/>
                            <div className="order-total">
                                <p className="order-total-text">
                                    <strong>Total:</strong> ${order.product.price}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};

export default UserOrderList;