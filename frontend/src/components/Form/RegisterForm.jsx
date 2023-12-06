import React, { useState } from 'react';
import '../../styles/Form/LoginForm.css';
import http from "../../axios";
import {loginUser} from "../../redux/actions/user";
import {useDispatch} from "react-redux";
import {useHistory} from "react-router-dom";

const RegisterForm = ({ onLogin }) => {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const dispatch = useDispatch();
    const history = useHistory();

    const handleLogin = (event) => {
        event.preventDefault();
        onLogin({ name, email, password });

        const credentials = {
            name: name,
            email: email,
            password: password,
        };

        http.post('api/register', credentials)
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
                <button onClick={handleLogin} className={'button-login'}>Register</button>
            </form>

        </div>
    );
};

export default RegisterForm;
