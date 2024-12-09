import './bootstrap';
import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";


Alpine.plugin(Intersect)
Alpine.start()

// If you want Alpine's instance to be available globally
window.Alpine = Alpine