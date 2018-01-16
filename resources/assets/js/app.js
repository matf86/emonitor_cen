
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en';
import { scroll } from './utils/smoothscroll';

window.scroll = scroll;
window.Vue = require('vue');

if (process.env.MIX_APP_ENV === 'production') {
    Vue.config.devtools = false;
    Vue.config.debug = false;
    Vue.config.silent = true;
}

let loader = document.getElementsByClassName("loader");
loader[0].className += " hide";


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(ElementUI, {locale});

Vue.component('offer-showcase', require('./components/UserFrontend/OfferShowcase.vue'));
Vue.component('vertical-nav', require('./components/Dashboard/VerticalNav.vue'));
Vue.component('offer-manager', require('./components/Dashboard/OfferManager.vue'));
Vue.component('markets-manager', require('./components/Dashboard/MarketsManager/MarketsManager.vue'));
Vue.component('date-range-picker', require('./components/DateRangePicker.vue'));
Vue.component('date-picker', require('./components/DatePicker.vue'));
Vue.component('pagination', require('./components/Pagination.vue'));
Vue.component('contactForm', require('./components/ContactForm.vue'));
Vue.component('marketBox', require('./components/MarketBox.vue'));

const app = window.app = new Vue({
    el: '#wrapper',
    methods: {
      showContactForm() {
          this.$emit('show-contact-form');
      }
    },
    mounted() {
        window.scroll();
    }
});

window.events = new Vue();
window.noData = function(message) {
    window.events.$emit('no-data', message);
};


