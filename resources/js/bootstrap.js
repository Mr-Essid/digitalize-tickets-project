import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import 'bootstrap'


import * as Popper from '@popperjs/core'
window.Popper = Popper

