import http from "../axios";
import {useState} from "react";

const useProductFunctions = () => {

    const [product, setProduct] = useState([]);

    const getProductById = (id) => {
        http.get('api/product/' + id)
            .then((res) => {
                setProduct(res.data)
            })
            .catch((er) => {
                console.log(er)
            })
    };

    return { product, setProduct, getProductById };
};

export default useProductFunctions;
