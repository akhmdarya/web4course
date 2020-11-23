
<?php ob_start();?>
<?php 
    $url = "authorization.php";
    session_start();
    if ($_SESSION['user']!=""){
        $url="profile.php";
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>GOPRO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>


    <section class="menu" id="menu">
        <div class="menu-inner">
            <a class="menu-list__item" onclick="toggleDropList" id="menu-list__item1" href="#">GOPRO <img class="caret"
                    id="caret" src="images/caret-down.svg">
            </a>

            <div class="panel">
                <a href="info.html" class="a">
                    <p class="panel-text">CAMERAS</p>
                </a>
                <a href="#" class="a">
                    <p class="panel-text">HERO 8</p>
                </a>
                <a href="#" class="a">
                    <p class="panel-text">HERO 7</p>
                </a>
            </div>

            <a class="menu-list__item" onclick="toggleDropList" id="menu-list__item2" href="#">accessories
            </a>


            <a class="menu-list__item" id="menu-list__item3" href="#">shoot for awards
            </a>


        </div>
    </section>
    <section class="menu-backdrop" id="menu-backdrop" onclick="hideMenu()">
    </section>




    <section class="header">
        <div class="header-inner">



            <div class="head-inner-sides">
                <div class="head-inner-sides-left">
                    <img class="header-icon" src="images/gopro_logo_PNG3.png">
                </div>
                <div class="head-inner-sides-center">
                    <div class="head-inner-menu">

                        <li class="head-inner-menu-item accessories">
                            <a class="head-inner-menu-item-link" href="#">
                                <span class="head-inner-menu-item-text">cameras</span>
                            </a>
                        </li>
                        <li class="head-inner-menu-item accessories">
                            <a class="head-inner-menu-item-link" href="#">
                                <span class="head-inner-menu-item-text">accessories</span>
                            </a>
                        </li>
                        <li class="head-inner-menu-item accessories">
                            <a class="head-inner-menu-item-link" href="#">
                                <span class="head-inner-menu-item-text">apps</span>
                            </a>
                        </li>
                        <li class="head-inner-menu-item accessories">
                            <a class="head-inner-menu-item-link" href="#">
                                <span class="head-inner-menu-item-text">shoot for awards</span>
                            </a>
                        </li>
                    </div>


                </div>
                <div class="head-inner-sides-right">
                    <!-- <div class="head-inner-menu"> -->
                    <div class="head-inner-sides-right-container">
                    <a href=#>  <img class="right-container-item" src="images/global.svg"></a>
                        <a href="<?=$url;?>"> <img class="right-container-item" src="images/account.svg"></a>
                        <a href=#><img class="right-container-item" src="images/loupe.svg"></a>
                        <a href="buy.php"><img class="right-container-item" src="images/buy.svg"></a>
                    </div>
                </div>

                <!-- </div> -->
            </div>



            <img class="header-icon-mobile" src="images/line-menu.svg" onclick="showMenu()">


        </div>
    </section>
    <script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/footer-mobile.js"></script>
<script type="text/javascript" src="js/dropdown.js"></script>