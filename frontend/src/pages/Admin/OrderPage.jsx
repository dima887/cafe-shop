import React, {useEffect, useState} from 'react';
import AdminNavbar from '../../components/Admin/UI/AdminNavbar';
import OrderList from "../../components/Admin/Section/OrderList";
import useOrderFunctions from "../../hooks/useOrderFunctions";
import ModalNewOrder from "../../components/Admin/UI/ModalNewOrder";

const OrderPage = () => {
    const {orders, getAllOrder} = useOrderFunctions();
    const [isNewOrderModal, setIsNewOrderModal] = useState(false);

    useEffect(() => {
        getAllOrder();
        const socket = new WebSocket('ws://localhost:5000');

        socket.addEventListener('open', (event) => {
            console.log('WebSocket connection opened:', event);
        });

        socket.addEventListener('message', (event) => {
            console.log('WebSocket message received:', event.data);
            if (event.data === 'NewOrder') {
                setIsNewOrderModal(true);
                console.log(event.data);
            }
        });

        socket.addEventListener('close', (event) => {
            console.log('WebSocket connection closed:', event);
        });

        return () => {
            socket.close();
        };
    }, []);

    const isOpenNewOrderModal = () => {
        setIsNewOrderModal(!isNewOrderModal);
    };

    return (
        <div>
            <AdminNavbar/>

            <OrderList orders={orders} />

            <ModalNewOrder
                isOpen={isNewOrderModal}
                onClose={isOpenNewOrderModal}
            />
        </div>
    );
};

export default OrderPage;