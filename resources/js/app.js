require('./bootstrap');

window.Vue = require('vue');
import store from './store'


Vue.component('create-interview', require('./components/new_interview/CreateInterviewForm.vue').default);
Vue.component('preview-interview', require('./components/new_interview/PreviewInterviewForm.vue').default);
Vue.component('edit-interview', require('./components/new_interview/EditInterviewForm.vue').default);
Vue.component('interview-preview', require('./components/new_interview/InterviewPreview.vue').default);


const app = new Vue({
    el: '#app',  
    store
});