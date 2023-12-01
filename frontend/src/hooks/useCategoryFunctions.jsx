import {useEffect, useState} from 'react';
import {useDispatch} from "react-redux";

import http from "../axios";

const useBasketFunctions = () => {

    const [categories, setCategories] = useState([]);
    const dispatch = useDispatch();

    useEffect(() => {
        getCategories();
    }, [dispatch])


    const getCategories = () => {
        http.get('api/category')
            .then((res) => {
                setCategories(res.data)
            })
            .catch((er) => {
                console.log(er)
            })
    }



    return { categories };
};

export default useBasketFunctions;
