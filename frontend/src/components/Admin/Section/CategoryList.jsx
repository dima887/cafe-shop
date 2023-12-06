import React from 'react';
import '../../../styles/Admin/Section/CategoryList.css';
import {Link} from "react-router-dom";

const CategoryList = ({ categories, deleteCategory }) => {
    return (
        <div className="category-list">
            <h2>All Categories</h2>
            {categories.map((category) => (
                <div key={category.id} className="category-item">
                    <div className="category-info">
                        <h3>Name: {category.category}</h3>
                        <p>Description: {category.description}</p>
                    </div>
                    <div className="category-actions">
                        <Link key={category.id} to={"/admin/categoryId/" + category.id}>
                            <button>View</button>
                        </Link>
                        <Link key={category.id} to={"/admin/categoryEdit/" + category.id}>
                            <button>Edit</button>
                        </Link>
                        <button onClick={() => deleteCategory(category.id)}>Delete</button>
                    </div>
                </div>
            ))}
        </div>
    );
};

export default CategoryList;