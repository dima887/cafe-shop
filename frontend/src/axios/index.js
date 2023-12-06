import axios from "axios";

const http = axios.create({
    baseURL: 'http://api.shop.local:8080/',
    withCredentials: true,
});

export default http;