import {useState} from 'react';

import http from "../axios";

const useCategoryFunctions = () => {

    const [category, setCategory] = useState([]);


    const getAllCategory = () => {
        http.get('api/category')
            .then((res) => {
                setCategory(res.data)
            })
            .catch((er) => {
                console.log(er)
            })
    }

    const getCategoryById = (id) => {
        http.get('api/category/' + id)
            .then((res) => {
                setCategory(res.data[0])
                console.log(res.data[0])
            })
            .catch((er) => {
                console.log(er)
            })
    };

    const updateCategory = (id) => {
        http.put('api/category/' + id, {
            category: category.category,
            description: category.description,
            thumbnail: 'https://via.placeholder.com/640x480.png/00ffcc?text=non'
        })
            .then((res) => {

            })
            .catch((err) => {
                console.log(err)
            })
    }

    const deleteCategory = (id) => {
        http.delete('api/category/' + id)
            .then((res) => {
                removeCategoryFromList(id)
            })
            .catch((er) => {
                console.log(er);
            });
    }

    const removeCategoryFromList = (category) => {
        setCategory(category.filter(c => c.id !== category))
    }


    return { category, setCategory, getAllCategory, getCategoryById, updateCategory, deleteCategory};
};

export default useCategoryFunctions;
