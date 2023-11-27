import React from 'react';

const NameSection = ({ name }) => {
    return (
        <div>
            <h2 className="name-section">{ name }</h2>
            <hr className="hr-home-page"/>
        </div>
    );
};

export default NameSection;