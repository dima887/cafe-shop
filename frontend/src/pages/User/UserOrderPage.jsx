import React, {useEffect} from 'react';
import useOrderFunctions from "../../hooks/useOrderFunctions";
import Navbar from "../../components/UI/Navbar";
import UserNav from "../../components/UI/UserNav";
import UserOrderList from "../../components/Section/UserOrderList";
import {useSelector} from "react-redux";

const UserOrderPage = () => {
    const {orders, getOrderByUserID} = useOrderFunctions();
    const user = useSelector((state) => state.user);


    useEffect(() => {
        getOrderByUserID(user.user.id);
    });

    return (
        <div>
            <Navbar />
            <br/>
            <br/>
            <br/>
            <br/>
            <UserNav />
            <UserOrderList orders={orders} />

        </div>
    );
};

export default UserOrderPage;