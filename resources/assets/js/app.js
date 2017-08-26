// kita import bootstrap.js - karena di file ini nantinya kita akan import semua package2 yg telah kita install di node_modules
import './bootstrap';
// kita import router.js - file ini belum kita buat, file ini khusus kita gunakan untuk menghandle route vue kita. Kita akan buat file ini setelah vue instance
import Router from './router';

// vue instance
new Vue({
   el: '#app',
   router: Router
});