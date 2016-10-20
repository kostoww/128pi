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
                    <div class="col s3"> <a data-ng-click="changeBgColor($event)" class="{{myButton}} btn-large waves-effect waves-light " href="" id="17">light</a> &nbsp;</div>
                    <div class="col s3"> <a data-ng-click="changeBgColor3($event)" class="{{myButton2}} btn-large waves-effect waves-light " href="" id="4">xmas</a> &nbsp;</div>
                    <div class="col s3"> <a data-ng-click="changeBgColor1($event)" class="{{myButton1}} btn-large waves-effect waves-light " href="" id="2">desk</a> &nbsp;</div>
                    <div class="col s3"> <a data-ng-click="changeBgColor2($event)" class="btn-large waves-effect waves-light orange" href="" id="25">main</a> &nbsp;</div>
                </div>
            </div>

        </div>
          <div class="collection col s12 center">`

              <div ng-init="get_data()">
                <div ng-repeat="clicks in clicks">
                    <a href="#" class="collection-item left-align"><b>{{clicks.browser}}</b>/<b>{{clicks.os}}</b> {{clicks.state}} {{clicks.type}}<span class="badge">{{clicks.date}}</span></a>
                </div>
              </div>

          </div>
      </div>
      <br><br>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>