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
import adminPostCreate from './components/Admin/Posts/Create';
import innerpageCategory from './components/Admin/Category/Index';
import adminCategoryEdit from './components/Admin/Category/Edit';
import adminCategoryCreate from './components/Admin/Category/Create';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import CKEditor from '@ckeditor/ckeditor5-vue';


const app = createApp({});
app.use(vuetify);
app.use(CKEditor);
app.component('MyAlert', MyAlert);
app.component('InnerpagePosts', innerpagePosts);
app.component('AdminPostEdit', adminPostEdit);
app.component('AdminPostCreate', adminPostCreate);
app.component('EasyDataTable', Vue3EasyDataTable);
app.component('InnerpageCategory', innerpageCategory);
app.component('AdminCategoryEdit', adminCategoryEdit);
app.component('AdminCategoryCreate', adminCategoryCreate);

app.mount('#app');
