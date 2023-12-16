import React, {useEffect, useState} from 'react';
import AdminNavbar from "../../components/Admin/UI/AdminNavbar";
import CategoryList from "../../components/Admin/Section/CategoryList";
import http from "../../axios";
import CreateCategoryModal from "../../components/Admin/UI/CreateCategoryModal";
import useCategoryFunctions from "../../hooks/useCategoryFunctions";

const AdminHomePage = () => {

    const { category, setCategory, getAllCategory, deleteCategory} = useCategoryFunctions();
    const [isModel, setIsModal] = useState(false);
    const [categoryForm, setCategoryForm] = useState({
        category: '',
        description: '',
        thumbnail: ''
    });

    useEffect(() => {
        getAllCategory();
    }, [])

    const isOpen = () => {
        setIsModal(!isModel);
    };

    const addCategory = (newCategory) => {
        setCategory([...category, newCategory])
    };

    const storeCategory = (category) => {
        http.post('api/category', category)
            .then((res) => {
                addCategory(category)
                setCategoryForm({
                    category: '',
                    description: '',
                    thumbnail: ''
                })
                isOpen();
            })
            .catch((er) => {
                console.log(er);
            });

    }


    return (
        <div>
            <AdminNavbar/>

            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div className="section-button-create">
                <button onClick={isOpen}>Create New Category</button>
            </div>
            <CreateCategoryModal
                isOpen={isModel}
                onClose={isOpen}
                sendForm={storeCategory}
                categoryForm={categoryForm}
                setCategoryForm={setCategoryForm}
            />

            <CategoryList categories={category} deleteCategory={deleteCategory}/>
        </div>
    );
};

export default AdminHomePage;