import React, {useEffect, useState} from 'react';
import { useParams } from 'react-router-dom';
import '../styles/Page/PostPage.css';
import Navbar from "../components/UI/Navbar";
import Footer from "../components/UI/Footer";
import http from "../axios";

const PostPage = () => {
    const { id } = useParams();

    const [news, setNews] = useState([]);

    useEffect(() => {
        const getAllNews = () => {
            http.get('api/news/' + id)
                .then((res) => {
                    setNews(res.data)
                })
                .catch((er) => {
                    console.log(er)
                })
        };

        getAllNews();
    }, [])

    const post = news.find((post) => post.id === parseInt(id));

    if (!post) {
        return <div>Post not found</div>;
    }

    return (
        <div>
            <Navbar/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div className="post-page">
                <img src={post.thumbnail} alt={post.title} className="post-image" />
                <div className="post-details">
                    <h2>{post.header}</h2>
                    <p>{post.content}</p>
                </div>
            </div>

            <Footer/>
        </div>
    );
};

export default PostPage;

