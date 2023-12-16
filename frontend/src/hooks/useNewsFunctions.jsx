import http from "../axios";
import {useState} from "react";

const useNewsFunctions = () => {

    const [news, setNews] = useState([]);

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

    const getNewsById = (id) => {
        http.get('api/news/' + id)
            .then((res) => {
                setNews(res.data)
            })
            .catch((er) => {
                console.log(er)
            })
    };

    return { news, setNews, getAllNews, getNewsById };
};

export default useNewsFunctions;
