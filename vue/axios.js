import axios from "axios";
import useAuthentication from "./src/stores/authentication";
import { useRouter } from "vue-router";
const axiosClient = axios.create({
    baseURL: "http://localhost:8000",
    withCredentials: true,
    headers: { Accept: "application/json" },
});
const router = useRouter();
axiosClient.interceptors.response.use(
    (response) => Promise.resolve(response),
    (error) => {
        if (error.response.status == 401 || error.response.status == 419) {
            const authentication = useAuthentication();
            authentication.setAuthenticated(false);
            router.push({ name: "resume" });
        }

        return Promise.reject(error);
    }
);

export default axiosClient;
