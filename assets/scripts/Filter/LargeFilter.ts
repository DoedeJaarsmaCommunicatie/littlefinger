import Vue from 'vue';
// @ts-ignore
import FilterApp from './Filter.vue';

new Vue({
    render: h => h(FilterApp),
}).$mount('#filter-app');
