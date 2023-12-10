import http from "../axios";
import {useState} from "react";

const useOrderFunctions = () => {

    const [orders, setOrders] = useState([]);


    const getAllOrder = () => {
        http.get('api/order')
            .then((res) => {
                setOrders(res.data);
            })
            .catch((err) => {
                console.log(err);
            })
    }

    const getOrderByUserID = (id) => {
        http.get('api/order/user/' + id)
            .then((res) => {
                setOrders(res.data);
            })
            .catch((err) => {
                console.log(err);
            })
    }



    return { orders, setOrders, getAllOrder, getOrderByUserID};
};

export default useOrderFunctions;
