import React from 'react';
import Navbar from "../../components/UI/Navbar";
import UserNav from "../../components/UI/UserNav";
import {useSelector} from "react-redux";
import UserProfileSection from "../../components/Section/UserProfileSection";

const UserProfilePage = () => {

    const user = useSelector((state) => state.user);

    return (
        <div>
            <Navbar />
            <br/>
            <br/>
            <br/>
            <br/>
            <UserNav />
            <UserProfileSection user={user} />
        </div>
    );
};

export default UserProfilePage;