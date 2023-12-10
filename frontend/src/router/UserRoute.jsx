import React from 'react';
import { Redirect, Route } from 'react-router-dom';

const UserRoute = ({ component: Component, isUser, ...rest }) => (
    <Route
        {...rest}
        render={(props) =>
            isUser ? (
                <Component {...props} />
            ) : (
                <Redirect to="/" />
            )
        }
    />
);

export default UserRoute;