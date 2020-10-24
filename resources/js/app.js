require('./bootstrap');

window.Vue = require('vue');

// DataTable
import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

// AXIOS
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)

// Form Wizard
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
Vue.use(VueFormWizard)

//modal
import VModal from 'vue-js-modal'
Vue.use(VModal, { dialog: true });


import ExampleComponent from './components/ExampleComponent.vue';
import DetailComponent from './components/DetailComponent.vue';
import FormIndexComponent from './components/employers/FormIndexComponent.vue';
const app = new Vue({
    el: '#app',
    components: {
        "ExampleComponent": ExampleComponent,
        "FormIndex": FormIndexComponent,
        "Detail": DetailComponent
    }
});
