import React from 'react';
import '../../styles/Section/WelcomeSection.css';

const WelcomeSection = () => {
    return (
        <section className="welcome-section">
            <div className="welcome-container">
                <div className="welcome-text">
                    <h1>Welcome to CafeApp</h1>
                    <hr/>
                    <p>Your go-to place for delicious food and refreshing drinks in a cozy atmosphere.</p>
                </div>
            </div>
        </section>
    );
};

export default WelcomeSection;
