<!DOCTYPE html>
<html lang="de" xmlns:type="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?> | Bbc MVC</title>

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">

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
                    <input id="suchleiste" type="text" placeholder="Search" onchange=""> 
                    <input type="button" id="uploadButton" onclick="" value="Upload"></li>
                    </form>
                        <li class="loginbutton"> <a class="listLink" href="/user/login">Login</a>
                        <a class="listLink" href="/user/create">Register</a></li>
                    </li>

                </ul>
              </div>
            <div id="topbar">
              <ul>
                <li class="button"><a class="listLink" href="/">Home</a></li>
                <li class="button"><a class="listLink" href="/user">Bildergalerie</a></li>
                <li class="button"><a class="listLink" href="/user/create">Benutzer</a></li>
              </ul>

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

    <h1><?= $heading ?></h1>
