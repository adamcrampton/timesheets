import Vue from 'vue';
window.Vue = require('vue');

Vue.component('recorder', require('./components/recorder.vue').default);
Vue.component('entries', require('./components/entries.vue').default);

new Vue({
    el: '#recorder-wrapper'
});