
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
// import DataTables from 'vue-data-tables';

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(ElementUI, {locale});
// Vue.use(DataTables);
// 
Vue.component('price-list', require('./components/PriceList.vue'));

const app = new Vue({
    el: '#app'
});

window.events = new Vue();

window.noData = function(message) {
    window.events.$emit('no-data', message);
};