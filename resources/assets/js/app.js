
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(ElementUI, {locale});

Vue.component('offer-showcase', require('./components/UserFrontend/OfferShowcase.vue'));
Vue.component('vertical-nav', require('./components/Dashboard/VerticalNav.vue'));
Vue.component('offer-manager', require('./components/Dashboard/OfferManager.vue'));
Vue.component('date-range-picker', require('./components/DateRangePicker.vue'));
Vue.component('date-picker', require('./components/DatePicker.vue'));
Vue.component('pagination', require('./components/Pagination.vue'));



const app = new Vue({
    el: '#app'
});

window.events = new Vue();

window.noData = function(message) {
    window.events.$emit('no-data', message);
};


