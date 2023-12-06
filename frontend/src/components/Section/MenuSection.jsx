import React from 'react';
import '../../styles/Section/MenuSection.css';
import '../../styles/UI/NameSection.css';
import CategoryCard from "../UI/CategoryCard";
import NameSection from "../UI/NameSection";

const MenuSection = ({ categories } ) => {
    return (
        <section className="menu-section">
            <NameSection name={"Menu"}/>
            <div className="menu-container">
                {categories.map((item, index) => (
                    <CategoryCard
                        key={index}
                        category={item.category}
                        image={item.thumbnail}
                        description={item.description}
                    />
                ))}
            </div>
        </section>
    );
};

export default MenuSection;
