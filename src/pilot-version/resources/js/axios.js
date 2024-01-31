import axios from "axios";

const axiosInstance = axios.create({
    baseURL: 'http://localhost/',
    headers: {
        "Content-type": "application/json",
    },
})

export default axiosInstance