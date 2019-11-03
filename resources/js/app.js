require('./bootstrap');

import Vue from 'vue'
import Header from './components/header-pos.vue'
import Main from './components/component-pos.vue'
import ComponentCategory from './components/component-category.vue'



new Vue({
    el: '#ar',
    components: {
       'atas' : Header,
       'isi' : Main,
       'component-category' : ComponentCategory
    }
});