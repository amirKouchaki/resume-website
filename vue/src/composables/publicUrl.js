export function publicPath($path) {
    return import.meta.env.BASE_URL + $path;
}
