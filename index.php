<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>128 : Raspberry PI</title>
  <script type="text/javascript" src="js/jquery-3.1.1.min.js" ></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.js" ></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">


    <?php
    include("config.php");
    $isclicked[][] = "";
    $FirstQuery = "SELECT * FROM `lights` WHERE `type`= 17  ORDER BY `id` DESC LIMIT 1";
    $resultFirstQuery = $estCon->query($FirstQuery);

    if ($resultFirstQuery->num_rows > 0) {
        while($row = $resultFirstQuery->fetch_assoc()) {
            ($row['state'] == 1) ? $isclicked['light']['state'] = "false" : $isclicked['light']['state'] = "true";
            ($row['state'] == 1) ? $isclicked['light']['color'] = "materialize-red" : $isclicked['light']['color'] = "light-green";
        }
    }

    $secondQuery = "SELECT * FROM `lights` WHERE `type`= 2  ORDER BY `id` DESC LIMIT 1";
    $resultSecondQuery = $estCon->query($secondQuery);
    if ($resultSecondQuery->num_rows > 0) {
        while($row = $resultSecondQuery->fetch_assoc()) {
            ($row['state'] == 1) ? $isclicked['led']['color'] = "materialize-red" : $isclicked['led']['color'] = "light-green";
            ($row['state'] == 1) ? $isclicked['led']['state'] = "false" : $isclicked['led']['state'] = "true";
        }
    }

    $thirdQuery = "SELECT * FROM `lights` WHERE `type`= 4  ORDER BY `id` DESC LIMIT 1";
    $resultThirdQuery = $estCon->query($thirdQuery);
    if ($resultThirdQuery->num_rows > 0) {
        while($row = $resultThirdQuery->fetch_assoc()) {
            ($row['state'] == 1) ? $isclicked['xmas']['color'] = "materialize-red" : $isclicked['xmas']['color'] = "light-green";
            ($row['state'] == 1) ? $isclicked['xmas']['state'] = "false" : $isclicked['xmas']['state'] = "true";
        }
    }
    ?>
    <script>
        var myApp = angular.module("myApp", []);
        myApp.controller("myController", function($scope, $http) {

            $scope.get_data = function(){
                $http.get('viewer.php').success(function(data){

                    $scope.clicks = data;
                    return $scope;
                });
            }

            $scope.isClicked = <?php echo $isclicked['light']['state']; ?>;
            $scope.myButton = "<?php echo $isclicked['light']['color']; ?>";
            $scope.isClicked1 = <?php echo $isclicked['led']['state']; ?>;
            $scope.myButton1 = "<?php echo $isclicked['led']['color']; ?>";
            $scope.isClicked2 = <?php echo $isclicked['xmas']['state']; ?>;
            $scope.myButton2 = "<?php echo $isclicked['xmas']['color']; ?>";
            $scope.changeBgColor = function(event) {

                if($scope.isClicked == false) {

                    var request = $http({
                        method: "post",
                        url:  "somefile.php?pin="+event.target.id+"&value=0",
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    /* Check whether the HTTP Request is successful or not. */
                    request.success(function (data) {
                        $scope.myButton = "light-green";
                        $scope.isClicked = true;
                        Materialize.toast('Изключена!', 1000, 'rounded')
                        $scope.get_data();
                    });
                    request.error(function(serverResponse, status, headers, config) {
                        alert("failure");
                    });

                } else {

                    var request = $http({
                        method: "post",
                        url:  "somefile.php?pin="+event.target.id+"&value=1",
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    /* Check whether the HTTP Request is successful or not. */
                    request.success(function (data) {
                        $scope.myButton = "materialize-red";
                        $scope.isClicked = false;
                        Materialize.toast('Включена!', 1000, 'rounded')
                        $scope.get_data();
                    });
                    request.error(function(serverResponse, status, headers, config) {
                        alert("failure");
                    });

                }
            };
            $scope.changeBgColor1 = function(event) {

                if($scope.isClicked1 == false) {

                    var request = $http({
                        method: "post",
                        url:  "somefile.php?pin="+event.target.id+"&value=0",
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    /* Check whether the HTTP Request is successful or not. */
                    request.success(function (data) {
                        $scope.myButton1 = "light-green";
                        $scope.isClicked1 = true;
                        Materialize.toast('Изключена!', 1000, 'rounded')
                        $scope.get_data();
                    });
                    request.error(function(serverResponse, status, headers, config) {
                        alert("failure");
                    });

                } else {

                    var request = $http({
                        method: "post",
                        url:  "somefile.php?pin="+event.target.id+"&value=1",
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    /* Check whether the HTTP Request is successful or not. */
                    request.success(function (data) {

                        $scope.myButton1 = " materialize-red";
                        $scope.isClicked1 = false;
                        Materialize.toast('Включена!', 1000, 'rounded')
                        $scope.get_data();
                    });
                    request.error(function(serverResponse, status, headers, config) {
                        alert("failure");
                    });

                }
            };

            $scope.changeBgColor2 = function(event) {

                if($scope.isClicked == false) {

                    var request = $http({
                        method: "post",
                        url:  "somefile.php?pin="+event.target.id+"&value=0",
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    /* Check whether the HTTP Request is successful or not. */
                    request.success(function (data) {
                        $scope.isClicked = true;
                        Materialize.toast('Изключена!', 1000, 'rounded')
                        $scope.get_data();
                    });
                    request.error(function(serverResponse, status, headers, config) {
                        alert("failure");
                    });

                } else {

                    var request = $http({
                        method: "post",
                        url:  "somefile.php?pin="+event.target.id+"&value=1",
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    /* Check whether the HTTP Request is successful or not. */
                    request.success(function (data) {
                        $scope.isClicked = false;
                        Materialize.toast('Включена!', 1000, 'rounded')
                        $scope.get_data();
                    });
                    request.error(function(serverResponse, status, headers, config) {
                        alert("failure");
                    });

                }
            };

            $scope.changeBgColor3 = function(event) {

                if($scope.isClicked2 == false) {

                    var request = $http({
                        method: "post",
                        url:  "somefile.php?pin="+event.target.id+"&value=0",
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    /* Check whether the HTTP Request is successful or not. */
                    request.success(function (data) {
                        $scope.myButton2 = "light-green";
                        $scope.isClicked2 = true;
                        Materialize.toast('Изключена!', 1000, 'rounded')
                        $scope.get_data();
                    });
                    request.error(function(serverResponse, status, headers, config) {
                        alert("failure");
                    });

                } else {

                    var request = $http({
                        method: "post",
                        url:  "somefile.php?pin="+event.target.id+"&value=1",
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    });

                    /* Check whether the HTTP Request is successful or not. */
                    request.success(function (data) {

                        $scope.myButton2 = " materialize-red";
                        $scope.isClicked2 = false;
                        Materialize.toast('Включена!', 1000, 'rounded')
                        $scope.get_data();
                    });
                    request.error(function(serverResponse, status, headers, config) {
                        alert("failure");
                    });

                }
            };

        });
    </script>
</head>
<body>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container" ng-app="myApp">
      <br><br>
      <h1 class="header center orange-text">PI Web Controller</h1>
      <div class="row center" ng-controller="myController">

        <div class="row ">
            <div >
                <div >
                    <div data-ng-click="changeBgColor($event)" class="mainbutton btn col s12 m6 l3 {{myButton}}  waves-effect waves-light " id="17">light</div>
                    <div data-ng-click="changeBgColor3($event)" class="mainbutton btn col s12 m6 l3 {{myButton2}}  waves-effect waves-light " id="4">xmas</div>
                    <div data-ng-click="changeBgColor1($event)" class="mainbutton btn col s12 m6 l3  {{myButton1}}  waves-effect waves-light" id="2">desk</div>
                    <div data-ng-click="changeBgColor2($event)" class="mainbutton btn col s12 m6 l3  btnwaves-effect waves-light orange" id="25">main</div>
                </div>
            </div>

        </div>
          <div class="collection col s12 center">`
              <h6 class="header center orange-text">History</h6>
              <div ng-init="get_data()">
                <div ng-repeat="clicks in clicks">
                    <a href="#" class="collection-item left-align"><b>{{clicks.os}}</b> {{clicks.state}} {{clicks.type}}<span class="badge">{{clicks.date}}</span></a>
                </div>
              </div>

          </div>
      </div>
      <br><br>

    </div>
  </div>

  <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>