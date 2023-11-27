import React from 'react';

const ReviewCard = ({ category, image, description, rating }) => {
    return (
        <div className="review-card">
            <div className={"review-card-content " + image} >
                <h2 className="review-card-category">{category}</h2>
                <p className="review-card-description">Average Rating: {rating} <span className="review-star">&#9733;</span></p>
                <p className="review-card-description">&#8220; {description} &#8221;</p>
            </div>
        </div>
    );
};

export default ReviewCard;
