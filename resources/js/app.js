/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import { createApp } from 'vue';
import vuetify from './plugins/vuetify';

import MyAlert from './components/MyAlert.vue';
import innerpagePosts from './components/Admin/Posts/Index';
import adminPostEdit from './components/Admin/Posts/Edit';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import CKEditor from '@ckeditor/ckeditor5-vue';


const app = createApp({});
app.use(vuetify);
app.use(CKEditor);
app.component('my-alert', MyAlert);
app.component('innerpage-posts', innerpagePosts);
app.component('admin-post-edit', adminPostEdit);
app.component('easy-data-table', Vue3EasyDataTable);

app.mount('#app');
