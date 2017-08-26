// kita akan gunakan bootstrap-sass
try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

// import vue dan vue router 
window.Vue       = require('vue');
window.VueRouter = require('vue-router');

// gunakan vue router pada vue
Vue.use(VueRouter);