import Vue from 'vue';

import axios from 'axios';

import axios_cors from 'axios';

window.Vue = Vue;

window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': Laravel.csrfToken
};

window.axios_cors = axios_cors;
window.axios_cors.defaults.headers.common = {};

window.$ = window.jQuery = require('jquery');