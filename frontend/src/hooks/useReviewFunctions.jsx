import http from "../axios";
import {useState} from "react";

const useReviewFunctions = () => {

    const [reviews, setReview] = useState([]);

    const getReviewByIdProduct = (id) => {
        http.get('api/review/product/' + id)
            .then((res) => {
                setReview(res.data)
            })
            .catch((er) => {
                console.log(er)
            })
    }

    return { reviews, setReview, getReviewByIdProduct };
};

export default useReviewFunctions;
