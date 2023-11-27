import React, {useEffect, useState} from 'react';
import AdminNavbar from "../../components/Admin/UI/AdminNavbar";
import http from "../../axios";
import {useParams} from "react-router-dom";
import EditCategoryForm from "../../components/Admin/Form/EditCategoryForm";

const AdminCategoryEditPage = () => {

    const { id } = useParams();

    const [category, setCategory] = useState([]);

    useEffect(() => {
        const getCategoryById = () => {
            http.get('api/category/' + id)
                .then((res) => {
                    setCategory(res.data[0])
                    console.log(res.data[0])
                })
                .catch((er) => {
                    console.log(er)
                })
        };

        getCategoryById();
    }, [])

    const updateCategory = () => {
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

    return (
        <div>
            <AdminNavbar/>

            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <EditCategoryForm
                id={id}
                sendForm={updateCategory}
                categoryForm={category}
                setCategoryForm={setCategory}
            />
        </div>
    );
};

export default AdminCategoryEditPage;