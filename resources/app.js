import Vue from 'vue';
import store from './store/store.js';
import quiz from './components/quiz.vue';

new Vue({
    el: '#app',
    store,
    render: h => h(quiz),
});