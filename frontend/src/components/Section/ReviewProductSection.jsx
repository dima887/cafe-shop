import React from 'react';
import '../../styles/Section/ReviewProductSection.css';

const ReviewProductSection = ({ reviews }) => {

    return (
        <div className="reviews-section">
            <h2>Customer Reviews</h2>
            <div className="reviews-list">
                {reviews.map((review) => (
                    <div key={review.id} className="review">
                        <div className="review-header">
                            <h3>{review.user.name}</h3>
                            <p>{review.updated_at}</p>
                        </div>
                        <p className="review-content">{review.review}</p>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default ReviewProductSection;
