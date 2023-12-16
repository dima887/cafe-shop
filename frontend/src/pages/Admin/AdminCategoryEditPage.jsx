import React, {useEffect} from 'react';
import AdminNavbar from "../../components/Admin/UI/AdminNavbar";
import {useParams} from "react-router-dom";
import EditCategoryForm from "../../components/Admin/Form/EditCategoryForm";
import useCategoryFunctions from "../../hooks/useCategoryFunctions";

const AdminCategoryEditPage = () => {

    const { id } = useParams();

    const { category, setCategory, getCategoryById, updateCategory } = useCategoryFunctions();
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