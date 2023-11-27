import React from 'react';
import { Link } from 'react-router-dom';

const CategoryCard = ({ category, image, description }) => {
    return (
        <div className="menu-card">
            <img src={image} alt={category} className="card-image" />
            <div className="card-content">
                <h2 className="card-category">{category}</h2>
                <p className="card-description">{description}</p>
                <Link to="/menu" className="card-link">
                    Explore
                </Link>
            </div>
        </div>
    );
};

export default CategoryCard;
