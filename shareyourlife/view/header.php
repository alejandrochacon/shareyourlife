<!DOCTYPE html>
<html lang="de" xmlns:type="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?></title>

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
      <link href="/css/style2.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body background="/images/bg.jpeg" >
      <nav class="navbarhead">
      <div class="container">
        <div class="navbar-header">


        </div>
        <div id="navbar">

            <div id="register">
                <ul id="registerbutton">
                    <li class="suche">
                    <li id="search" >
                    <form method="post" action="/bilder/suche">
                    <input id="suchleiste" type="text" placeholder="Search" onchange=""/></li>
                    </form>
                    <?php if (!Account::isLoggedIn()) : ?>
                    <li class="loginbutton"> <a class="listLink" href="/user/login">Login</a>
                        <a class="listLink" href="/user/create">Register</a></li>
                    <?php else : ?>


                   <li class="loginbutton" id="logoutbutton"> <a class="listLink" href="/user/logout">Logout</a></li>

                        <li id="loggedname">eingeloggt als <?= Account::getUsername() ?></li>
                        <li class="upload"><a href="/bilder/upload"  id="uploadButton">Upload</a></li>
                    <?php endif ?>


                    
                        

                </ul>
              </div>
            <div id="topbar">
              <ul>
                <li class="button"><a class="listLink" href="/">Home</a></li>
                <li class="button"><a class="listLink" href="/bilder">Bildergalerie</a></li>
                <li class="button"><a class="listLink" href="/user/myaccount">Benutzer</a></li>
              </ul>

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

    <h1><?= $heading ?></h1>