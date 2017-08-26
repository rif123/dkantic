<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Forum</title>
   <!-- // ini file app.css yg baru kita compile -->
   <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
   <div id="app">
   <!-- // tambahkan tag baru ini, ini akan menampilkan component route yg telah kita buat di router.js -->
      <router-view></router-view>
   </div>
   <!-- // ini file app.js yg baru kita compile -->
   <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>