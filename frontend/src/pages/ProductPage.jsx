import React, {useEffect, useState} from 'react';
import {Link, useParams} from 'react-router-dom';
import '../styles/Page/PostPage.css';
import Navbar from "../components/UI/Navbar";
import Footer from "../components/UI/Footer";
import http from "../axios";
import ReviewProductSection from "../components/Section/ReviewProductSection";
import ReviewForm from "../components/Form/ReviewForm";
import useBasketFunctions from "../hooks/useBasketFunctions";
import {useSelector} from "react-redux";
import useProductFunctions from "../hooks/useProductFunctions";
import useReviewFunctions from "../hooks/useReviewFunctions";

const ProductPage = () => {
    const { id } = useParams();
    const [reviewForm, setReviewForm] = useState({review: ''});
    const { setBasketInCookie } = useBasketFunctions();
    const user = useSelector((state) => state.user);
    const { product, getProductById } = useProductFunctions();
    const { reviews, setReview, getReviewByIdProduct} = useReviewFunctions();

    useEffect(() => {
        getProductById(id)
        getReviewByIdProduct(id);
    }, [])

    const isProduct = product.find((post) => post.id === parseInt(id));

    if (!isProduct) {
        return <div>Product not found</div>;
    }

    const addReview = (newReview) => {
        setReview([...reviews, newReview])
    };

    const storeReview = () => {
        http.post('api/review', {
            review: reviewForm.review,
            user_id: user.user.id,
            product_id: id
        })
            .then((res) => {
                let time = new Date();
                addReview({
                    product_id: id,
                    user: { name: user.user.name },
                    review: reviewForm.review,
                    updated_at: time.toISOString()
                });
                setReviewForm({review: ''})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    return (
        <div>
            <Navbar/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div className="post-page">
                <img src={isProduct.thumbnail} alt={product.title} className="post-image" />
                <p onClick={() => setBasketInCookie(isProduct.id, isProduct.name, isProduct.price)}
                   className="page-card-link pointer">
                    Add to basket
                </p>
                <div className="post-details">
                    <h2>{isProduct.name}</h2>
                    <p>Price: {isProduct.price} £</p>
                    <p>Description: {isProduct.description}</p>
                </div>
            </div>

            <ReviewProductSection reviews={reviews} />

            {(!user.user) ?
                <div className="no-login-container">
                    <span className="no-login-text">
                        <Link to="/login"><span className="no-login-toLogin">Login</span></Link> to your account to leave a review
                    </span>
                </div>
            :
                <ReviewForm
                    sendForm={storeReview}
                    reviewForm={reviewForm}
                    setReviewForm={setReviewForm}
                />
            }

            <Footer/>
        </div>
    );
};

export default ProductPage;

