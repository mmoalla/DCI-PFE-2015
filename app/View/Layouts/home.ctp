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
<html lang="fr" ng-app="appDci">
    <head>
        <?php
        echo $this->Html->charset("utf-8");
        echo $this->Html->meta('favicon.ico', 'favicon.ico', array('type' => 'icon'));
        echo $this->Html->meta(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'));
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));
        ?>
        <title>Dossier Clinique Informatisé :: Bienvenue</title>
        <!-- CSS Files -->
        <?php
        //Bootstrap CSS
        echo $this->Html->css('bootstrap.min');
        //Application CSS
        echo $this->Html->css('main');
        echo $this->Html->css('print', array('media' => 'print'));
        //Peace CSS
        echo $this->Html->css('pace/pace-theme-barber-shop');
        //Pickadate CSS
        echo $this->Html->css('pickadate/classic');
        echo $this->Html->css('pickadate/classic.date');
        echo $this->Html->css('pickadate/classic.time');
        echo $this->Html->css('font-awsome/font-awesome.min');
        echo $this->Html->css('animate/animate');
        //DataTable CSS
        echo $this->Html->css('JqueryDT/jquery.dataTables.min');
        //Other CSS In Views
        echo $this->fetch('css');
        ?>
        <style type="text/css">
            .pace{
                //opacity: 0.7;
                //height: 60px;
            }
        </style>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- All Content HERE  -->
        <?php
        echo $this->element('header');
        echo $this->Session->flash();
        ?>
        <div class="container-fluid" style="margin-top: 60px;">
            <?php
            echo $this->element('sidebar_doc');
            ?>
            <div class="col-lg-10 col-lg-offset-2" style="margin-bottom: 20px;">
                <div class="dci-ici" style="margin-top: 10px;">
                    <ul class="breadcrumb">
                        <li style="font-size: 14px;">
                            <?php
                            echo $this->Html->getCrumbs(' > ', array(
                                'text' => 'Accueil',
                                'url' => array('controller' => 'pages', 'action' => 'home'),
                                'escape' => false
                            ));
                            ?></li>
                    </ul>
                    <span class="dci-today">
                        <?php 
                        echo $this->Html->script('moment/moment.min'); 
                        echo $this->Html->script('moment/ar-tn');
                        ?>
                        <?php echo $this->Html->scriptStart(array('inline' => false)); ?>
                        jQuery().ready(function (){
                            moment().locale('fr');
                            $('.dci-today').append(moment().format('dddd DD MMMM YYYY'));
                        });
                        
                        <?php echo $this->Html->scriptEnd(); ?>
                    </span>
                </div>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <!-- Javascript Files -->
        <?php
        //JQuery
        echo $this->Html->script('jquery-1.11.2.min');
        //AngularJS
        echo $this->Html->script('angularjs/angular.min');
        //Filter
        echo $this->Html->script('select2/select2.min');
        //Application
        echo $this->Html->script('main');
        //Typehead
        echo $this->Html->script('typehead/typeahead.bundle');
        //Bootstrap
        echo $this->Html->script('bootstrap/bootstrap.min');
        echo $this->Html->script('bootstrap/tooltip');
        //Browser update
        echo $this->Html->script('browser-update');
        //DataTable
        echo $this->Html->script('JqueryDT/jquery.dataTables.min');
        //Peace
        echo $this->Html->script('pace/pace.min');
        //Wizard Form
        echo $this->Html->script('Wizard/jquery.bootstrap.wizard');
        //Pikadate
        echo $this->Html->script('pickadate/picker');
        echo $this->Html->script('pickadate/picker.date');
        echo $this->Html->script('pickadate/picker.time');
        echo $this->Html->script('pickadate/legacy'); //FOR IE8 compatibility datepicker
        echo $this->Html->script('pickadate/fr_FR'); //For translate language datepicker
        //Other Script in views
        echo $this->fetch('script');
        ?>
        <?php echo $this->Html->scriptStart(); ?>
        var appDci = angular.module("appDci", []);
        appDci.controller('NationaliteController', NationaliteController);
        function NationaliteController($scope, $http) {
            $http.get("<?php echo $this->Html->url('/js/jsons/Countries.json', true); ?>").success(function (response) {
                $scope.nt = response;
            });
        }
        appDci.controller('CurrencyController', CurrencyController);
        function CurrencyController($scope, $http) {
            $http.get("<?php echo $this->Html->url('/js/jsons/Currency.json', true); ?>").success(function (response) {
                $scope.currency = response;
            });
        }
        appDci.controller('MedicamentsController', MedicamentsController);
        function MedicamentsController($scope, $http) {
            $http.get("<?php echo $this->Html->url('http://localhost/DCI/home/stocks/filter.json', true); ?>").success(function (response) {
                $scope.medocs = response;
            });
        }
        appDci.controller('StocksController', StocksController);
        function StocksController($scope, $http) {
            $http.get("<?php echo $this->Html->url('http://localhost/DCI/home/stocks.json', true); ?>").success(function (response) {
                $scope.stocks = response;
            });
        }
        <?php echo $this->Html->scriptEnd(); ?>
    </body>
</html>