import React from 'react';
import '../styles/Page/MenuPage.css';
import Navbar from "../components/UI/Navbar";
import NameSection from "../components/UI/NameSection";
import MenuList from "../components/UI/MenuList";
import Footer from "../components/UI/Footer";
import useCategoryFunctions from "../hooks/useCategoryFunctions";
import useBasketFunctions from "../hooks/useBasketFunctions";

const MenuPage = () => {

    const { categories } = useCategoryFunctions();
    const { setBasketInCookie } = useBasketFunctions();

    return (
        <div className="menu-page">
            <Navbar/>

            <br/>
            <br/>
            <br/>
            <br/>
            <NameSection name="Menu"/>
            <p className="describe-our-menu">Indulge in an exquisite culinary experience with our menu that transcends
                ordinary dining. Immerse yourself in a symphony of flavors crafted with passion and precision, where
                each dish is a masterpiece of culinary artistry. Our carefully curated menu showcases a fusion of
                diverse cuisines, promising a gastronomic journey that tantalizes the taste buds. From delectable hot
                drinks that warm the soul to sumptuous meals that redefine comfort, every item on our menu is a
                celebration of exceptional ingredients and innovative cooking techniques. Elevate your dining experience
                with us, where every dish tells a story of dedication to quality and a commitment to delivering
                unparalleled satisfaction. Explore the extraordinary and savor the extraordinary – because at our
                establishment, the menu is not just a list; it's an invitation to savor the extraordinary.</p>

            {categories.map((category, index) => (
                <div key={index}>
                    <NameSection name={category.category} />
                    <section className="page-menu-section">
                        <div className="page-menu-container">
                            {category.products.map((item, itemIndex) => (
                                <MenuList
                                    key={itemIndex}
                                    id={item.id}
                                    name={item.name}
                                    image={item.thumbnail}
                                    price={item.price}
                                    setBasketInCookie={setBasketInCookie}
                                />
                            ))}
                        </div>
                    </section>
                </div>
            ))}

            <Footer/>
        </div>
    );
};

export default MenuPage;