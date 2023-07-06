export function initSidenavBurger(page) {
    var sidenav = document.querySelector("aside");
    var sidenav_trigger = document.querySelector("[sidenav-trigger]");
    var sidenav_close_button = document.querySelector("[sidenav-close]");

    sidenav_trigger.addEventListener("click", function () {
        sidenav_close_button.classList.toggle("hidden");
        sidenav.classList.toggle("translate-x-0");
        sidenav.classList.toggle("shadow-soft-xl");
    });
    sidenav_close_button.addEventListener("click", function () {
        sidenav_trigger.click();
    });

    window.addEventListener("click", function (e) {
        if (
            !sidenav.contains(e.target) &&
            !sidenav_trigger.contains(e.target)
        ) {
            if (sidenav.classList.contains("translate-x-0")) {
                sidenav_trigger.click();
            }
        }
    });
}
