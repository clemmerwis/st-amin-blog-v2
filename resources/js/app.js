require('./bootstrap');

import Vue from 'vue'
Vue.component('innerpage-posts', require('./components/Admin/Posts/Index.vue').default)
// Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app'
});
