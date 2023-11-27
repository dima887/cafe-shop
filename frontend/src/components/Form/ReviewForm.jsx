import React from 'react';
import '../../styles/Form/ReviewForm.css';

const ReviewForm = ({ sendForm, reviewForm, setReviewForm }) => {
    const addReview = (event) => {
        event.preventDefault();
        sendForm();
    }

    return (
        <div className="review-form">
            <h2>Add a Review</h2>
            <form>
                <label>
                    Review:
                    <textarea
                        value={reviewForm.review}
                        onChange={e => setReviewForm({...reviewForm, review: e.target.value})}
                        required
                    />
                </label>
                <button onClick={addReview} type="submit">Submit Review</button>
            </form>
        </div>
    );
};

export default ReviewForm;
