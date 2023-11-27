import React from 'react';
import '../../styles/Section/ReviewSection.css';
import NameSection from "../UI/NameSection";
import ReviewCard from "../UI/ReviewCard";

const ReviewSection = () => {

    const menu = [
        {
            category: "Hot Drinks",
            image: "background-review-card-hot-drinks",
            description: "Will definitely buy again.",
            rating: "5"
        },
        {
            category: "Breakfast",
            image: "background-review-card-breakfast",
            description: "Could improve on delivery time.",
            rating: "4.7"
        },
        {
            category: "Bakery Treats",
            image: "background-review-card-bakery-treats",
            description: "Great products!",
            rating: "4.9"
        },
    ];

    return (
        <section className="review-section">
            <NameSection name={"Review"}/>
            <div className="review-container">
                {menu.map((item, index) => (
                    <ReviewCard
                        key={index}
                        category={item.category}
                        image={item.image}
                        description={item.description}
                        rating={item.rating}
                    />
                ))}
            </div>
        </section>
    );
};

export default ReviewSection;
