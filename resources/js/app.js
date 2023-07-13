import "./bootstrap";
import multiselect from "./alpine-components/multiselect";
import Alpine from "alpinejs";

Alpine.data("multiselect", multiselect);

window.Alpine = Alpine;

Alpine.start();
