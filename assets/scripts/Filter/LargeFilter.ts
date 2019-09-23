import Vue from 'vue';
// @ts-ignore
import FilterApp from './Filter.vue';

if (document.getElementById('filter-app')) {
    new Vue({
        render: h => h(FilterApp),
    }).$mount('#filter-app');
}
