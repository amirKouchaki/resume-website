import useAuthentication from "../../../stores/authentication";

const handle = (to, from, next) => {
    const authentication = useAuthentication();
    if (authentication.authenticated) next({ name: "dashboard" });
    next();
};

export default handle;
