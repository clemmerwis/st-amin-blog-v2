require('./bootstrap');

import Vue from 'vue'

Vue.component('innerpage-posts',
    require('./components/Admin/Posts/Index.vue').default)

const app = new Vue({
    el: '#app'
});
