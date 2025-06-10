import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import '../vendor/bootstrap/dist/js/bootstrap.bundle.min.js'
import './functions.js'
import './front/swiperSlider.js'
import './darkMode.js'
import './common/successNotification.js'
import.meta.glob(['../assets/images/**']);




