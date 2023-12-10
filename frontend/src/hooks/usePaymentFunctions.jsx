import {useSelector} from "react-redux";
import {useLocation} from "react-router-dom";

import http from "../axios";

const useBasketFunctions = () => {

    const product = useSelector((state) => state.basket)
    const location = useLocation();
    const user = useSelector((state) => state.user.user);

    const payment = () => {
        product.user_id = user.id;
        product.type_order_id = 1;
        product.success_url = "http://shop.local:3000" + location.pathname + "?payment=true";
        product.cancel_url = "http://shop.local:3000" + location.pathname + "?payment=false";
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
