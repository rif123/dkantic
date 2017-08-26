// kita import vue router
import VueRouter from 'vue-router';

// buat variable Routes - di variable inilah kita akan daftarkan semua route forum kita
let Routes = [
   {
      // ini hanya alias route kalau dilaravel biasa kita pakai as atau name
      name: 'forumIndex',
      // ini path view, maksudnya bila kita mengunjungi http://localhost:8000/forum maka route ini yg akan menghandle
      // penting diingat path: '/' ini bukan berarti http://localhost:8000/ melainkan http://localhost:8000/forum
      path: '/',
      // ini adalah tampilan/component yang akan munculkan saat user mengunjungi http://localhost:8000/forum - kita belum buat component ini
      component: require('./views/ForumIndex') 
   }
];
// kemudian kita export default vue router instance beserta routes yg telah kita defenisikan di atas
export default new VueRouter({
   routes: Routes
});