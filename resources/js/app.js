/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import { createApp } from 'vue'
import vuetify from './plugins/vuetify'


const app = createApp({})
app.use(vuetify)

import innerpagePosts from './components/Admin/Posts/Index'
import test from './components/Admin/Posts/Test'
import Vue3EasyDataTable from 'vue3-easy-data-table'
import 'vue3-easy-data-table/dist/style.css'



app.component('innerpage-posts', innerpagePosts)
app.component('test-test', test)
app.component( 'easy-data-table', Vue3EasyDataTable);


app.mount('#app')
