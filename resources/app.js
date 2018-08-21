import Vue from 'vue';
import store from './store/store.js';
import quiz from './components/quiz.vue';
import './styles/main.scss';

new Vue({
    el: '#app',
    store,
    render: h => h(quiz),
});