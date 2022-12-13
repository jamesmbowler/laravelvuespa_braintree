import './bootstrap';
import '../sass/app.scss'
import Router from '@/router'
import store from '@/store'

import { createApp } from 'vue/dist/vue.esm-bundler';
import LoadScript from "vue-plugin-load-script";

const app = createApp({})
app.use(Router)
app.use(store)
app.use(LoadScript);
app.mount('#app')