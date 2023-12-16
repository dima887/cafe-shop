import React from 'react';
import '../../styles/Form/LoginForm.css';
import useAuthFunctions from "../../hooks/useAuthFunctions";

const LoginForm = () => {

    const { email, setEmail, password, setPassword, handleLogin } = useAuthFunctions();

    return (
        <div className="login-form">
            <h2>Login</h2>
            <form>
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
                    <label htmlFor="password" >Password:</label>
                    <input className={'input-login'}
                        type="password"
                        id="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                </div>
                <button onClick={handleLogin} className={'button-login'}>Login</button>
            </form>

        </div>
    );
};

export default LoginForm;
