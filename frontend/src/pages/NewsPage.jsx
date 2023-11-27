import React, {useEffect, useState} from 'react';
import Navbar from "../components/UI/Navbar";
import NameSection from "../components/UI/NameSection";
import NewsList from "../components/UI/NewsList";
import http from "../axios";

const NewsPage = () => {

    const [news, setNews] = useState([]);

    useEffect(() => {
        const getAllNews = () => {
            http.get('api/news')
                .then((res) => {
                    const modifiedNews = res.data.map((item) => ({
                        ...item,
                        content: item.content.length > 50 ? item.content.slice(0, 50) + '...' : item.content,
                    }));
                    setNews(modifiedNews);
                })
                .catch((er) => {
                    console.log(er);
                });
        };

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