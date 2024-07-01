import "./bootstrap";
import "leaflet/dist/leaflet.js";

import Alpine from "alpinejs";
import focus from "@alpinejs/focus";

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
