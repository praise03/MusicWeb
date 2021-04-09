<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Music web application</title>
    <meta name="description" content="Music, Musician, Bootstrap">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="css/animate.css/animate.min.css" type="text/css">
    <link rel="stylesheet" href="css/glyphicons/glyphicons.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/material-design-icons/material-design-icons.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/styles/app.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles/toogleButton.css">
</head>

<script type="text/javascript">
    function darkMode() {
      var element = document.getElementById("body");
      element.classList.toggle("dark");
    }
</script>

<body id="body">
<?php $connection = mysqli_connect('localhost', 'root', '', 'music_and_images'); ?>
<?php ob_start(); ?>
<?php session_start(); ?>

    
    <div class="app dk" id="app">
        <div id="aside" class="app-aside modal fade nav-dropdown" style="min-height: -webkit-fill-available;">
            <div class="left navside grey dk" data-layout="column" style="min-height: -webkit-fill-available;">
                <div class="navbar no-radius">
                    <a href="index.php" class="navbar-brand md">
                        <span class="hidden-folded inline">music</span></a></div>
                <div data-flex class="hide-scroll">
                    <nav class="scroll nav-stacked nav-active-primary">
                        <ul class="nav" data-ui-nav>
                            <li class="nav-header hidden-folded"><span class="text-xs text-muted">main</span></li>
                            <li>
                                <a href="albums.php">
                                  <span class="nav-icon"><i class="material-icons">play_circle_outline</i></span>
                                    <span class="nav-text">Albums</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="songs.php"><span class="nav-icon"><i class="material-icons">portrait</i></span>
                                   <span class="nav-text">Songs</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="search.php"><span class="nav-icon"><i class="material-icons">search</i></span>
                                  <span class="nav-text">Search</span>
                                </a>
                            </li>
                            <br><br>
                            <li>
                                <a >
                                  <span class="nav-text">Dark Mode 
                                        <div class="toggle-container">
                                          <input onchange="darkMode()" type="checkbox" />
                                          <div class="slider round"></div>
                                        </div>
                                  </span>

                                </a>
                            </li>

                            <?php 
                              if (isset($_SESSION['username']) && $_SESSION['username']=='admin') {
                                echo '
                                    <li>
                                        <a href="logout.php"><span class="nav-icon"><i class="material-icons">portrait</i></span>
                                           <span class="nav-text">Logout</span>
                                        </a>
                                    </li>';
                              }
                            ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div id="content" class="app-content white bg box-shadow-z2" style="min-height: -webkit-fill-available;" role="main">
            <!-- nav -->
            <div class="app-header hidden-lg-up white lt box-shadow-z1">
                <div class="navbar"><a href="index.php" class="navbar-brand md">
                        <span class="hidden-folded inline">music</span></a>
                    <ul class="nav navbar-nav pull-right">
                        <li class="nav-item">
                            <a data-toggle="modal" data-target="#aside" class="nav-link">
                                <i class="material-icons">menu</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>