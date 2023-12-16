import {useDispatch, useSelector} from "react-redux";
import http from "../axios";
import {loginUser, logoutUser} from "../redux/actions/user";
import {useState} from "react";
import {useHistory} from "react-router-dom";
const useAuthFunctions = () => {

    const user = useSelector((state) => state.user)
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const dispatch = useDispatch();
    const history = useHistory();

    const isAuthenticated = () => {
        return user.user !== null;

    }

    const isAdmin = () => {
        if (isAuthenticated()) {
            return user.user.role === 'admin';
        }
    }

    const getAuthUser = () => {
        http.get('api/user')
            .then((res) => {
                user.user = res.data
            })
            .catch((err) => {
                console.log(err)
            })
    }

    const handleLogin = (event) => {
        event.preventDefault();

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

    const handleRegister = (event) => {
        event.preventDefault();

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

    const handleLogout = () => {
        http.post('api/logout')
            .then((res) => {
                dispatch(logoutUser());
            })
            .catch((err) => {
                console.error('Logout failed', err);
            });
    };

    return { name, setName, email, setEmail, password, setPassword, isAdmin, isAuthenticated, getAuthUser, handleLogin, handleRegister, handleLogout };
};

export default useAuthFunctions;
