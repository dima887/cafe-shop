import React from 'react';
import '../../styles/Form/LoginForm.css';
import useAuthFunctions from "../../hooks/useAuthFunctions";

const RegisterForm = () => {
    const { name, setName, email, setEmail, password, setPassword, handleRegister } = useAuthFunctions();

    return (
        <div className="login-form">
            <h2>Register</h2>
            <form>
                <div className="input-group">
                    <label htmlFor="name" className={'label-login'}>Name:</label>
                    <input className={'input-login'}
                        type="text"
                        id="name"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                    />
                </div>
                <div className="input-group">
                    <label htmlFor="email" className={'label-login'}>Email:</label>
                    <input className={'input-login'}
                        type="email"
                        id="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                </div>
                <div className="input-group">
                    <label htmlFor="password" className={'label-login'}>Password:</label>
                    <input className={'input-login'}
                        type="password"
                        id="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                </div>
                <button onClick={handleRegister} className={'button-login'}>Register</button>
            </form>

        </div>
    );
};

export default RegisterForm;
