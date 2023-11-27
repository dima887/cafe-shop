import React from 'react';
import { Link } from 'react-router-dom';
import '../../styles/UI/NewsList.css';

const NewsList = ( {news} ) => {

    return (
        <div className="news-list">
            {news.map((post) => (
                <Link key={post.id} to={"/post/" + post.id} className="news-post">
                    <img src={post.thumbnail} alt={post.header} className="post-image" />
                    <div className="post-details">
                        <h2>{post.header}</h2>
                        <p>{post.content}</p>
                    </div>
                </Link>
            ))}
        </div>
    );
};

export default NewsList;
