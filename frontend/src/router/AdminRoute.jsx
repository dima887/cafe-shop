import React from 'react';
import { Redirect, Route } from 'react-router-dom';

const AdminRoute = ({ component: Component, isAdmin, ...rest }) => (
    <Route
        {...rest}
        render={(props) =>
            isAdmin ? (
                <Component {...props} />
            ) : (
                <Redirect to="/" />
            )
        }
    />
);

export default AdminRoute;