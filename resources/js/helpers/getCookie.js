export function getCookie(name) {
    const cookie = document.cookie.split(";").find((cookie) => {
        return cookie.trim().startsWith(name + "=");
    });

    if (!cookie) {
        return null;
    }

    return cookie.split("=")[1];
}
