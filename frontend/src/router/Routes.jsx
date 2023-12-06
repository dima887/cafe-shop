import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import HomePage from "../pages/HomePage";
import AboutPage from "../pages/AboutPage";
import LoginPage from "../pages/LoginPage";
import NewsPage from "../pages/NewsPage";
import PostPage from "../pages/PostPage";
import MenuPage from "../pages/MenuPage";
import ProductPage from "../pages/ProductPage";
import AdminHomePage from "../pages/Admin/AdminHomePage";
import AdminCategoryIdPage from "../pages/Admin/AdminCategoryIdPage";
import AdminCategoryEditPage from "../pages/Admin/AdminCategoryEditPage";
import RegisterPage from "../pages/RegisterPage";
import AdminRoute from "./AdminRoute";
const Routes = ({ isAdmin } ) => {

    return (
        <Router>
            <Switch>
                <Route path="/" exact component={HomePage} />
                <Route path="/news" component={NewsPage} />
                <Route path="/post/:id" component={PostPage} />
                <Route path="/menu" component={MenuPage} />
                <Route path="/product/:id" component={ProductPage} />
                <Route path="/about" component={AboutPage} />
                <Route path="/login" component={LoginPage} />
                <Route path="/register" component={RegisterPage} />

                <AdminRoute path="/admin/category" component={AdminHomePage} isAdmin={isAdmin}/>
                <AdminRoute path="/admin/categoryId/:id" component={AdminCategoryIdPage} isAdmin={isAdmin} />
                <Route path="/admin/categoryEdit/:id" component={AdminCategoryEditPage} isAdmin={isAdmin} />
            </Switch>
        </Router>
    );
};

export default Routes;