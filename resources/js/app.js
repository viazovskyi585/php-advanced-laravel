import "./bootstrap";
import multiselect from "./alpine-components/multiselect";
import imageInput from "./alpine-components/imageInput";
import Alpine from "alpinejs";
import Api from "./api/Api";
import htmx from "htmx.org";

window.htmx = htmx;

Alpine.data("multiselect", multiselect);
Alpine.data("imageInput", imageInput);

window.Alpine = Alpine;
window.Api = Api;

Alpine.start();
