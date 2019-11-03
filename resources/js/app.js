require('./bootstrap');

import Vue from 'vue'
import Header from './components/header-pos.vue'
import Main from './components/component-pos.vue'



new Vue({
    el: '#ar',
    components: {
       'atas' : Header,
       'isi' : Main
    }
});