import React, {useEffect, useState} from 'react';
import Navbar from "../components/UI/Navbar";
import WelcomeSection from "../components/Section/WelcomeSection";
import MenuSection from "../components/Section/MenuSection";
import ReviewSection from "../components/Section/ReviewSection";
import Footer from "../components/UI/Footer";
import http from "../axios";
const HomePage = () => {

    const [categories, setCategories] = useState([]);
    const images = [
        "image/Hot-drinks.jpg",
        "image/Breakfast.jpg",
        "image/Bakery-Treats.jpg",
    ];

    useEffect(() => {
        const getAllCategory = () => {
            http.get('api/category')
                .then((res) => {
                    const categoriesWithImages = res.data.map((category, index) => ({
                        ...category,
                        image: images[index],
                    }));
                    setCategories(categoriesWithImages);
                })
                .catch((er) => {
                    console.log(er);
                });
        };

        getAllCategory();
    }, []);

    return (
        <div>
            <Navbar/>

            <WelcomeSection/>

            <MenuSection categories={categories}/>

            <ReviewSection/>

            <Footer/>
        </div>
    );
};

export default HomePage;