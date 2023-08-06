import { getCookie } from "../helpers/getCookie";

export default async (url, method, options = {}) => {
    const response = await fetch(url, {
        method: method,
        headers: {
            "X-Xsrf-Token": decodeURIComponent(getCookie("XSRF-TOKEN")),
            "X-Requested-With": "XMLHttpRequest",
        },
        ...options,
    });

    if (!response.ok) {
        throw new Error("Something went wrong." + response.statusText);
    }

    const data = await response.json();

    return data;
};
