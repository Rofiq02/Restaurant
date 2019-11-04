require('./bootstrap');

import Vue from 'vue'
import Header from './components/header-pos.vue'
import Main from './components/component-pos.vue'
import ComponentCategory from './components/component-category.vue'
import ComponentProduct from './components/component-product.vue'

import VueSweetalert2 from 'vue-sweetalert2'

import 'sweetalert2/dist/sweetalert2.min.css'

Vue.use(VueSweetalert2);

new Vue({
    el: '#ar',
    components: {
       'atas' : Header,
       'isi' : Main,
       'component-category' : ComponentCategory,
       'component-product' : ComponentProduct
    }
});