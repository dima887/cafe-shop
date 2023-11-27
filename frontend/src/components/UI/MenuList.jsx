import React from 'react';
import {Link} from "react-router-dom";

const MenuList = ({ id, name, image, price }) => {
    return (
        <div>
            <div className="page-menu-card">
                <img src={image} alt={name} className="page-card-image" />
                <div className="page-card-content">
                    <h2 className="page-card-category">{name}</h2>
                    <p className="page-card-description">Price: {price} £</p>
                    <p className="page-card-link">
                        Add to basket
                    </p>
                    <Link key={id} to={"/product/" + id} className="page-card-link">
                        Explore
                    </Link>
                </div>
            </div>
        </div>
    );
};

export default MenuList;