import React from 'react';
import LoginForm from '../components/Form/LoginForm';
import Navbar from "../components/UI/Navbar";
const LoginPage = () => {

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
                <LoginForm />
            </div>
        </div>
    );
};

export default LoginPage;
