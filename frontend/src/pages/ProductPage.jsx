import React, {useEffect, useState} from 'react';
import { useParams } from 'react-router-dom';
import '../styles/Page/PostPage.css';
import Navbar from "../components/UI/Navbar";
import Footer from "../components/UI/Footer";
import http from "../axios";
import ReviewProductSection from "../components/Section/ReviewProductSection";
import ReviewForm from "../components/Form/ReviewForm";

const ProductPage = () => {
    const { id } = useParams();

    const [product, setProduct] = useState([]);
    const [reviews, setReview] = useState([]);
    const [reviewForm, setReviewForm] = useState({review: ''});

    useEffect(() => {
        const getAllNews = () => {
            http.get('api/product/' + id)
                .then((res) => {
                    setProduct(res.data)
                })
                .catch((er) => {
                    console.log(er)
                })
        };

        const getReviewByIdProduct = () => {
            http.get('api/review/product/' + id)
                .then((res) => {
                    setReview(res.data)
                })
                .catch((er) => {
                    console.log(er)
                })
        }


        getAllNews();
        getReviewByIdProduct();
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
            user_id: 15,
            product_id: id
        })
            .then((res) => {
                let time = new Date();
                addReview({
                    product_id: id,
                    user: { name: 'admin' },
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
                <p className="page-card-link">
                    Add to basket
                </p>
                <div className="post-details">
                    <h2>{isProduct.name}</h2>
                    <p>Price: {isProduct.price} £</p>
                    <p>Description: {isProduct.description}</p>
                </div>
            </div>

            <ReviewProductSection reviews={reviews} />

            <ReviewForm
                sendForm={storeReview}
                reviewForm={reviewForm}
                setReviewForm={setReviewForm}
            />

            <Footer/>
        </div>
    );
};

export default ProductPage;

