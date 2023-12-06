import './App.css';
import React, {useEffect, useState} from "react";
import Routes from "./router/Routes";
import {useDispatch, useSelector} from "react-redux";
import {loginUser} from "./redux/actions/user";
import http from "./axios";


function App() {
    const [ isAdmin, setIsAdmin ] = useState(false);

    const user = useSelector((state) => state.user);
    const dispatch = useDispatch();

    useEffect(() => {
        http.get('/api/user')
            .then((res) => {
                dispatch(loginUser(res.data));
            })
            .catch((err) => {
                console.log(err)
            })
    }, [])

    useEffect(() => {
        if (user.user !== null) {
            if (user.user.role === 'admin') {
                setIsAdmin(true)
            }
        }
    }, [user.user])
  return (
    <div className="App">
         <Routes isAdmin={isAdmin}/>
    </div>
  );
}

export default App;
