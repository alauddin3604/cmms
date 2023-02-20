window.Vue = require('vue').default;

import { createApp } from 'vue';
import VueQRCodeComponent from 'vue-qrcode-component';
import pagination from 'laravel-vue-pagination';
import VueToast from 'vue-toast-notification';
import router from './router';
import axios from 'axios';
import '../css/app.css';

const app = createApp();
app.use(router).use(VueToast);
// app.use(store);
app.mount('#app');

app.component('qr-code', VueQRCodeComponent).component('pagination', pagination);

app.config.globalProperties.$http = axios;
//app.prototype.$userName = document.querySelector("meta[name='admin-name']").getAttribute('content');