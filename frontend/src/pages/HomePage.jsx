import React, {useEffect} from 'react';
import Navbar from "../components/UI/Navbar";
import WelcomeSection from "../components/Section/WelcomeSection";
import MenuSection from "../components/Section/MenuSection";
import ReviewSection from "../components/Section/ReviewSection";
import Footer from "../components/UI/Footer";
import useCategoryFunctions from "../hooks/useCategoryFunctions";
const HomePage = () => {

    const { category, getAllCategory} = useCategoryFunctions();

    useEffect(() => {
        getAllCategory();
    }, []);

    return (
        <div>
            <Navbar/>

            <WelcomeSection/>

            <MenuSection categories={category}/>

            <ReviewSection/>

            <Footer/>
        </div>
    );
};

export default HomePage;