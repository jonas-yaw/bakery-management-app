import './bootstrap';
import Alpine from 'alpinejs'

Alpine.plugin(Intersect)
Alpine.start()

// If you want Alpine's instance to be available globally
window.Alpine = Alpine