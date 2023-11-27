import React, {useEffect, useState} from 'react';
import AdminNavbar from "../../components/Admin/UI/AdminNavbar";
import http from "../../axios";
import {useParams} from "react-router-dom";
import Navbar from "../../components/UI/Navbar";
import Footer from "../../components/UI/Footer";
import CreateCategoryModal from "../../components/Admin/UI/CreateCategoryModal";

const AdminCategoryIdPage = () => {

    const { id } = useParams();

    const [categories, setCategory] = useState([]);

    useEffect(() => {
        const getAllNews = () => {
            http.get('api/category/' + id)
                .then((res) => {
                    setCategory(res.data)
                })
                .catch((er) => {
                    console.log(er)
                })
        };

        getAllNews();
    }, [])

    const category = categories.find((post) => post.id === parseInt(id));

    if (!category) {
        return <div>Category not found</div>;
    }

    return (
        <div>
            <AdminNavbar/>
            <br/>
            <br/>
            <br/>
            <br/>

            <div className="post-page">
                <img src={category.thumbnail} alt={category.category} className="post-image" />
                <div className="post-details">
                    <h2>{category.category}</h2>
                    <p>{category.description}</p>
                </div>
            </div>

            <Footer/>
        </div>
    );
};

export default AdminCategoryIdPage;