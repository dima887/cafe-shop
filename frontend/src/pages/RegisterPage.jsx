import React from 'react';
import Navbar from "../components/UI/Navbar";
import RegisterForm from "../components/Form/RegisterForm";

const RegisterPage = () => {

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
                <RegisterForm />
            </div>
        </div>
    );
};

export default RegisterPage;
