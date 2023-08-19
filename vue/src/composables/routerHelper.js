import router from "../router";

const updateRouteQuery = (key, value) => {
    const currentQuery = { ...router.currentRoute.value.query };

    if (value.trim().length !== 0) currentQuery[key] = value;
    else delete currentQuery[key];

    router.push({
        path: router.currentRoute.value.fullPath,
        query: currentQuery,
    });
};

export { updateRouteQuery };
