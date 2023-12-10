import React from 'react';
import '../../styles/Section/ReviewSection.css';

const UserProfileSection = ( { user }) => {


    return (
        <section className="review-section">
            <h3>Name: {user.user.name}</h3>
            <h3>Email: {user.user.email}</h3>
        </section>
    );
};

export default UserProfileSection;
