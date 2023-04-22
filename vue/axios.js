import axios from "axios";

const axiosClient = axios.create({
    baseURL: "http://localhost:8000",
    withCredentials: true,
    headers: { Accept: "application/json" },
});

// axiosClient.interceptors.response.use(
//     (response) => response,
//     (error) => {
//         if (error.response.status == 401 || error.response.status == 419) {
//             localStorage.removeItem("authenticated");
//             window.location.reload();
//         }

//         return Promise.reject(error);
//     }
// );

export default axiosClient;
