import React, { useState } from 'react';
import '../../../styles/Admin/UI/CreateCategoryModal.css';

const CreateCategoryModal = ({ isOpen, onClose, sendForm, categoryForm, setCategoryForm }) => {
    const addCategory = (event) => {
        event.preventDefault();
        categoryForm.thumbnail = 'https://via.placeholder.com/640x480.png/00ffcc?text=non';
        sendForm(categoryForm);
    }

    return (
        <div className={`create-category-modal ${isOpen ? 'open' : ''}`}>
            <div className="modal-content">
        <span className="close" onClick={onClose}>
          &times;
        </span>
                <h2>Create New Category</h2>
                <form className="form-create-category">
                    <label className="label-create-category">
                        Name:
                        <input className="input-create-category"
                            type="text"
                            onChange={(e) => setCategoryForm({...categoryForm, category: e.target.value})}
                            required
                        />
                    </label>
                    <label className="label-create-category">
                        Description:
                        <textarea className="input-create-category"
                            onChange={e => setCategoryForm({...categoryForm, description: e.target.value})}
                            required
                        ></textarea>
                    </label>
                    <button onClick={addCategory} type="submit" className="create-category-button">Create Category</button>
                </form>
            </div>
        </div>
    );
};

export default CreateCategoryModal;
