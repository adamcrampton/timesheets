import Axios from 'axios';
import Vue from 'vue';
window.Vue = require('vue');

Vue.component('recorder', require('./components/recorder.vue').default);

new Vue({
    el: '#recorder-wrapper'
});