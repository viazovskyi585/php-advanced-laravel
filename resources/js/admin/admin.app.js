import { initDropdown } from "./modules/dropdown";
import { initSidenavBurger } from "./modules/sidenav-burger";
import { initCharts } from "./modules/charts";
import { initStickyNavbar } from "./modules/sticky-navbar";

const page = "dashboard";
const aux = window.location.pathname.split("/");
const to_build = aux.includes("pages") ? "../" : "./";
const root = window.location.pathname.split("/");

initDropdown();
initSidenavBurger(page);
initCharts();
initStickyNavbar();

Echo.private("AdminChannel").listen(".UserRegistered", (e) => {
    console.log(e);
    iziToast.show({
        title: "User Registered",
        message: e.message,
        position: "topRight",
        color: "green",
    });
});
