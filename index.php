<!DOCTYPE html>
<html>
<head>
    <title>Fly Around</title>
    <meta name="application-name" content="Webpage">
    <meta name="language" content="fr">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">

    <!--css-->
    <link href="main.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="style1.css" media="all">
    <link rel="stylesheet" type="text/css" href="style2.css" media="all">

    <meta charset="utf-8">

    <!--<base href="localhost/preconnexion/">-->


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

</head>
<body class="home-slider">

<!--TYPO3SEARCH_begin-->

<div id="slideImageWrap">
    <img id="slideFront" src="img/calvi.jpg" style="left: -760px; z-index: -4; display: none;">
    <img id="slideBack" style="left: 0px; z-index: -5;" src="img/bonifacio.jpg">
</div>
<div id="homeNewsSlider">
    <div class="newsSlide left" style="top: -19px;">
        <div class="innerContent">
            <img class="slideImageSrc" data-src="img/bonifacio.jpg" alt="Bonifacio">
        </div>
    </div>
    <div class="newsSlide left" style="top: -16px;">
        <div class="innerContent">
            <img class="slideImageSrc" data-src="img/calvi.jpg" alt="Calvi">
        </div>
    </div>
    <div class="newsSlide left" style="top: -21px;">
        <div class="innerContent">
            <img class="slideImageSrc" data-src="img/chateau.jpg" alt="Chateau de Chambord">
        </div>
    </div>
    <div class="newsSlide left slideIn" style="top: -44px;">
        <div class="innerContent">
            <img class="slideImageSrc" data-src="img/fribourg.jpg" alt="Fribourg">
        </div>
    </div>
    <div class="newsSlide left" style="top: -2px;">
        <div class="innerContent">
            <img class="slideImageSrc" data-src="img/montsaintmichel.jpg" alt="Mont Saint Michel">
        </div>
    </div>
    <div class="newsSlide left" style="top: -2px;">
        <div class="innerContent">
            <img class="slideImageSrc" data-src="img/saint_barth.jpg" alt="Saint Barth">
        </div>
    </div>
    <div class="newsSlide right" style="top: 5px;">
        <div class="innerContent">
            <img class="slideImageSrc" data-src="img/viaducmillau.jpg" alt="viaduc de millau">
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>

<script src="typo3temp.js" type="text/javascript"></script>

<table style="height: 100%;width: 100%;"><tr><td style="vertical-align: middle;">

            <div class="container preconnexion">
                <div class="content">
                    <img class="logo" src="img/logo.png"/>
                    <img class="point" src="img/point.png"/>
                    <h2>survoler, découvrir, partager</h2>
                    <hr/>
                    <!--                <p>Avec <b>Fly</b>around, survolez et découvrez les plus beaux sites de France et partagez votre expérience du ciel</p>-->
                    <!--            <p><b>Fly</b>around sera bientot en ligne; vous pouvez dès à présent vous inscrire pour etre averti dès la mise en ligne</p>-->
                    <p><b>Fly</b>around votre guide touristique des airs<br/>Découvrez les plus beaux sites de France</p>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        $file = fopen('emails.txt', 'a+');
                        fputs($file, "\n".$_POST['email']);
                        fclose($file);
                        echo '<div style="background-color: #FFFFFF; color: #000000; font-size: 14px; padding: 10px;">';
                        echo($_POST['email'].' a bien été ajouté dans notre mailing liste.');
                        echo '</div>';
                    }
                    else
                    {
                        echo '<form method="post" action="index.php">';
                        echo '<input type="email" name="email" id="email" placeholder="adresse e-mail" style="background-image:url(img/logo_body.png);background-position:left;background-repeat:no-repeat"/>';
                        echo '<input type="image" class="submit" src="img/logo_check.png"/>';
                        echo '</form>';
                    }
                    ?>

                </div>
            </div>

        </td></tr></table>

</body>
</html>