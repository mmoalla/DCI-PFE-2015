<!-- 
Template Name: DCI - Administration Dashboard For Hospital 
Version: 1.0
Author: MOALLA Mehdi
Contact: mehdimoalla2010@gmail.com OR mehdi.moalla@esprit.tn
License: Open Source
-->
<?php
echo $this->Html->docType('html5');
?>
<html lang="fr" ng-app="appDci">
    <head>
        <?php
        echo $this->Html->charset();
        echo $this->Html->meta('favicon.ico', 'favicon.ico', array('type' => 'icon'));
        echo $this->Html->meta(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'));
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));
        ?>
        <title>Administration</title>
        <!-- CSS Files -->
        <?php
        //Bootstrap CSS
        echo $this->Html->css('bootstrap.min');
        //Application CSS
        echo $this->Html->css('main');
        echo $this->Html->css('pickadate/classic');
        echo $this->Html->css('pickadate/classic.date');
        echo $this->Html->css('font-awsome/font-awesome.min');
        echo $this->Html->css('animate/animate');
        echo $this->fetch('css');
        ?>

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
        echo $this->element('admin_header');
        ?>
        <div class="container" style="margin-top: 60px;">
            <?php
            echo $this->Session->flash();
            echo $this->fetch('content');
            ?>
        </div>
        <!-- Javascript Files -->
        <?php
        echo $this->Html->script('jquery-1.11.2.min');
        echo $this->Html->script('angularjs/angular.min');
        echo $this->Html->script('bootstrap/bootstrap.min');
        echo $this->Html->script('pickadate/picker');
        echo $this->Html->script('pickadate/picker.date');
        echo $this->Html->script('pickadate/legacy'); //FOR IE8 compatibility datepicker
        echo $this->Html->script('pickadate/fr_FR'); //For translate language datepicker
        echo $this->Html->script('browser-update');
        echo $this->Html->script('moment/moment.min'); 
        echo $this->Html->script('moment/fr');
        echo $this->fetch('script');
        ?>
        <?php echo $this->Html->scriptStart(); ?>
        var appDci = angular.module("appDci", []);
        appDci.controller('PresenceController', PresenceController);
        function PresenceController($scope, $http) {
            $http.get("http://localhost/DCI/admin/pages/presence.json").success(function (response) {
                $scope.today = new Date().toJSON().slice(0, 10);
                $scope.presences = response;    
            });
        }
        appDci.controller('UserController', UserController);
        function UserController($scope, $http) {
            $http.get("http://localhost/DCI/admin/grh.json").success(function (response) {
                $scope.users = response;                
            });
        }
        appDci.controller('ListConnecterController', ListConnecterController);
        function ListConnecterController($scope, $http) {
            setInterval(function(){
                $http.get("http://localhost/DCI/admin/users/list_connecter.json").success(function (response) {
                    $.each(response.dciSession,function(i,v){
                        response.dciSession[i].User.time_login = moment(response.dciSession[i].User.time_login).fromNow(); 
                    });
                    $scope.connecter = response.dciSession;   
                });
            }, 3000);
        }
        <?php echo $this->Html->scriptEnd(); ?>
    </body>
</html>