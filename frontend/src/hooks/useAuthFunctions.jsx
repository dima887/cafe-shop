import {useSelector} from "react-redux";
import http from "../axios";
const useAuthFunctions = () => {

    const user = useSelector((state) => state.user)

    const isAuthenticated = () => {
        return user.user !== null;

    }

    const isAdmin = () => {
        if (isAuthenticated()) {
            return user.user.role === 'admin';
        }
    }

    const getAuthUser = () => {
        http.get('api/user')
            .then((res) => {
                user.user = res.data
            })
            .catch((err) => {
                console.log(err)
            })
    }

    return { isAdmin, isAuthenticated, getAuthUser };
};

export default useAuthFunctions;
