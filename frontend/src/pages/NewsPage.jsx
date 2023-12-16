import React, {useEffect} from 'react';
import Navbar from "../components/UI/Navbar";
import NameSection from "../components/UI/NameSection";
import NewsList from "../components/UI/NewsList";
import useNewsFunctions from "../hooks/useNewsFunctions";

const NewsPage = () => {

    const { news, getAllNews } = useNewsFunctions();

    useEffect(() => {
        getAllNews();
    }, [])

    return (
        <div>
            <Navbar/>
            <br/>
            <br/>
            <br/>
            <br/>
            <NameSection name={'News'}/>

            <NewsList news={news}/>
        </div>
    );
};

export default NewsPage;