import useAuthentication from "../../../stores/authentication";

const handle = (to, from, next) => {
    const authentication = useAuthentication();
    if (!authentication.authenticated) next({ name: "resume" });
    next();
};

export default handle;
