import React from 'react';
import LoginForm from '../components/Form/LoginForm';
import Navbar from "../components/UI/Navbar";
const LoginPage = () => {
    const handleLogin = (credentials) => {
        console.log('Logging in with:', credentials);
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
                <LoginForm onLogin={handleLogin} />
            </div>
        </div>
    );
};

export default LoginPage;
