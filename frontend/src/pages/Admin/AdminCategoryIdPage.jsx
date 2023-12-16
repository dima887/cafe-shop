import React, {useEffect} from 'react';
import AdminNavbar from "../../components/Admin/UI/AdminNavbar";
import {useParams} from "react-router-dom";
import Footer from "../../components/UI/Footer";
import useCategoryFunctions from "../../hooks/useCategoryFunctions";

const AdminCategoryIdPage = () => {

    const { id } = useParams();

    const { category, getCategoryById} = useCategoryFunctions();

    useEffect(() => {
        getCategoryById(id);
    }, [])

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