<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css">
    <title>Блог</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid row">
        <a class="navbar-brand col-1" id="home">Блог</a>
        <script> get('.home', '/'); </script>
        <div class="navbar-collapse col-11" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" id="admin">Вход</a>
                <script>post('.admin', '/profile/administer')</script>
            </div>
        </div>
    </div>
</nav>
<?php
require '../vendor/autoload.php';
require_once 'Bootstrap.php';
?>
<script>
    import axios from 'axios';

    function get(element, url) {
        const button = document.querySelector(element)
        button.addEventListener("click", function() {
            axios.get(url);
        });
    }

    function post(element, url, param) {
        const button = document.querySelector(element)
        button.addEventListener("click", function() {
            axios.post(url, param);
        });
    }
</script>
</body>
</html>
