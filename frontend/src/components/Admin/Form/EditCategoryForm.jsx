import React from 'react';
import '../../../styles/Form/ReviewForm.css';

const EditCategoryForm = ({ id,  sendForm, categoryForm, setCategoryForm }) => {
    const updateCategory = (event) => {
        event.preventDefault();
        sendForm(id);
    }

    return (
        <div className="review-form">
            <h2>Edit Category: {id}</h2>
            <form>
                <label>
                    Category:
                    <input
                        type="text"
                        value={categoryForm.category}
                        onChange={(e) => setCategoryForm({...categoryForm, category: e.target.value})}
                        required
                    />
                </label>
                <label>
                    Description:
                    <textarea
                        value={categoryForm.description}
                        onChange={e => setCategoryForm({...categoryForm, description: e.target.value})}
                        required
                    />
                </label>
                <button onClick={updateCategory} type="submit">Submit Review</button>
            </form>
        </div>
    );
};

export default EditCategoryForm;
