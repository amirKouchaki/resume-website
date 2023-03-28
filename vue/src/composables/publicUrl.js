export function publicPath($path) {
    return import.meta.env.VITE_BASE_URL + $path;
}
