import React from 'react';
import Navbar from "../components/UI/Navbar";
import RegisterForm from "../components/Form/RegisterForm";

const RegisterPage = () => {
    const handleLogin = (credentials) => {
        console.log('Register in with:', credentials);
    };

    return (
        <div>
            <Navbar/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div className="login-container">
                <RegisterForm onLogin={handleLogin} />
            </div>
        </div>
    );
};

export default RegisterPage;
