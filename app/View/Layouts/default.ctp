<?php
echo $this->Html->docType('html5');
?>
<!-- 
Template Name: DCI - Dashboard For Hospital 
Version: 1.0
Author: MOALLA Mehdi
Contact: mehdimoalla2010@gmail.com OR mehdi.moalla@esprit.tn
License: Open Source
-->
<html lang="fr">
    <head>
        <?php
        echo $this->Html->charset();
        echo $this->Html->meta('favicon.ico', 'favicon.ico', array('type' => 'icon'));
        echo $this->Html->meta(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'));
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));
        ?>
        <title>DCI :: Bienvenue</title>
        <!-- CSS Files -->
        <?php
        //Bootstrap CSS
        echo $this->Html->css('bootstrap.min');
        //Application CSS
        echo $this->Html->css('main');
        echo $this->Html->css('animate/animate');
        echo $this->Html->css('font-awsome/font-awesome.min');
        //PEACE CSS
        echo $this->Html->css('pace/pace-theme-barber-shop');
        ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body style="padding: 0px 0px 0px 0px;">
        <!-- All Content HERE  -->
        <div class="container-fluid">
            <?php
            echo $this->Session->flash();
            echo $this->fetch('content');
            ?>
        </div>
        <!-- Javascript Files -->
        <?php
        //JQuery javascript
        echo $this->Html->script('jquery-1.11.2.min');
        //Bootstrap javascript
        echo $this->Html->script('bootstrap/bootstrap.min');
        //Browser notification update javascript
        echo $this->Html->script('browser-update');
        //Application Javascript
        echo $this->Html->script('main');
        //Peace Javascript
        echo $this->Html->script('pace/pace.min');
        //Other Scripts In Views
        echo $this->fetch('script');
        ?>
    </body>
</html>