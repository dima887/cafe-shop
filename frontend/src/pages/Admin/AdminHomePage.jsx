import React, {useEffect, useState} from 'react';
import AdminNavbar from "../../components/Admin/UI/AdminNavbar";
import CategoryList from "../../components/Admin/Section/CategoryList";
import http from "../../axios";
import CreateCategoryModal from "../../components/Admin/UI/CreateCategoryModal";

const AdminHomePage = () => {

    const [categories, setCategories] = useState([]);
    const [isModel, setIsModal] = useState(false);
    const [categoryForm, setCategoryForm] = useState({
        category: '',
        description: '',
        thumbnail: ''
    });

    useEffect(() => {
        const getAllCategory = () => {
            http.get('api/category')
                .then((res) => {

                    setCategories(res.data);
                })
                .catch((er) => {
                    console.log(er);
                });
        };

        getAllCategory();
    }, [])

    const isOpen = () => {
        setIsModal(!isModel);
    };

    const addCategory = (newCategory) => {
        setCategories([...categories, newCategory])
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

    const removeCategoryFromList = (category) => {
        setCategories(categories.filter(c => c.id !== category))
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

            <CategoryList categories={categories} deleteCategory={deleteCategory}/>
        </div>
    );
};

export default AdminHomePage;