import React, { useState } from 'react';
import '../../styles/Form/LoginForm.css';
import http from "../../axios";
import { useDispatch } from 'react-redux';
import { loginUser } from '../../redux/actions/user';
import {useHistory} from "react-router-dom";

const LoginForm = ({ onLogin }) => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const dispatch = useDispatch();
    const history = useHistory();
    const handleLogin = (event) => {
        event.preventDefault();
        onLogin({ email, password });

        const credentials = {
            email: email,
            password: password,
        };

        http.post('api/login', credentials)
            .then((res) => {
                dispatch(loginUser(res.data.user));
                history.push('/');
            })
            .catch((err) => {
                console.log(err)
            })
    };



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
