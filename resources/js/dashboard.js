import Alpine from "alpinejs";
import * as ToastComponent from "../../vendor/usernotnull/tall-toasts/dist/js/tall-toasts";
import persist from "@alpinejs/persist";
import TouchSweep from "touchsweep";

Alpine.data("ToastComponent", ToastComponent);
Alpine.plugin(persist);

window.TouchSweep = TouchSweep;

window.Alpine = Alpine;
Alpine.start();
