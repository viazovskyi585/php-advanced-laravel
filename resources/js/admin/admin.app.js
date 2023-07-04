import { initDropdown } from "./modules/dropdown";
import { initNavbar } from "./modules/navbar";
import { initSidenavBurger } from "./modules/sidenav-burger";

const page = "dashboard";
const aux = window.location.pathname.split("/");
const to_build = aux.includes("pages") ? "../" : "./";
const root = window.location.pathname.split("/");

initDropdown();
initNavbar();
initSidenavBurger(page);
