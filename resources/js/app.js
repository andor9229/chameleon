/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import VTooltip from 'v-tooltip';
import FormWizard from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
Vue.config.productionTip = false;

window.Vue = require('vue');

Vue.use(VTooltip);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(FormWizard);

const app = new Vue({
    el: '#app',
    data: {
        open: false,
        showaccountmodal: false,
        showdeleteresourcemodal: false,
        showshareorganizationmodel: false,
        showsourceaccesstokenmodel: false,
        bridgetype: null,
        url: null,
        source: null,
    },
    methods: {
        toggle() {
            this.open = !this.open
        },

        showAccountModal(visible) {
            this.showaccountmodal = visible;
        },

        showShareOrganizationModel(visible, url = '') {
            this.showshareorganizationmodel = visible;
            this.url = url;
        },

        showDeleteResourceModal(visible, url = '') {
            this.showdeleteresourcemodal = visible;
            this.url = url;
        },

        showSourceAccessTokenModal(visible, source = '') {
            this.showsourceaccesstokenmodel = visible;
            this.source = source;
        },
    }
});
