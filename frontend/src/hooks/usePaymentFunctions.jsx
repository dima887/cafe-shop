import {useSelector} from "react-redux";
import {useLocation} from "react-router-dom";

import http from "../axios";

const useBasketFunctions = () => {

    const product = useSelector((state) => state)
    const location = useLocation();


    const payment = () => {
        //todo userId
        product.user_id = 15;
        product.type_order_id = 1;
        product.success_url = "http://localhost:3000" + location.pathname + "?payment=true";
        product.cancel_url = "http://localhost:3000" + location.pathname + "?payment=false";
        http.post('/api/payment', product)
            .then((res) => {
                window.location.href = res.data.success;
            })
            .catch((err) => {
                console.log(err)
            })

    }



    return { payment };
};

export default useBasketFunctions;
