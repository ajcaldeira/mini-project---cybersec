<?php
    session_start();
    include 'model/api.php';
    if(!ValidateSession()){
        header("Location: view/login.html"); 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .btn-custom {
            width: 100%;
        }

        body {
            background: #f8f8f8;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <!-- CAMERA START -->
        <div style="padding:30px;border: 2px solid #0570E4;border-radius:8px;margin-bottom: 20px;" class="row">
            <div class="col-12">
                <h2 style="text-align:center;">Camera</h2>
                <img style="display:none;margin: 15px 0;border:2px solid #0570E4;" id="cam-img" width="100%"
                    height="auto" src="">
                <div id="take-photo" class="btn btn-primary btn-custom" type="button">Take Pic</div>
                <h3 style="display:none;" id="h3-img-loading" style="color: red;">Please Wait. Your image is loading...
                </h3>
            </div>
        </div>
        <!-- CAMERA END -->
        <div style="padding:30px;border: 2px solid #0570E4;border-radius:8px;margin-bottom: 20px;" class="row">
            <div class="col-12">
                <div id="arm-alarm" class="btn btn-primary btn-custom" type="button">Turn on panic button</div>
            </div>

        </div>
        <div style="padding:30px;border: 2px solid #0570E4;border-radius:8px;margin-bottom: 20px;" class="row">

            <div class="col-12">
                <div style="margin-bottom: 10px;" class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" value="alarm">
                    <label class="custom-control-label" for="customCheck1">Alarm</label>
                </div>
                <div id="sub-topics" class="btn btn-primary btn-custom" type="button">Subscribe to topics</div>
            </div>
            <div style="margin-top: 10px;" class="col-12">
                <div id="pub-topics" class="btn btn-danger btn-custom" type="button">Sound the alarm!</div>
            </div>
        </div>
        <div class="row">
            <div style="width: 250px;margin-top: 10px;" class="col-12">
                <div id="logout" class="btn btn-danger" type="button">Log Out</div>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
        $("#take-photo").click(function () {
            $("#h3-img-loading").css("display", "block");
            $.ajax({
                url: 'controller/pic.php',
                type: 'POST'
            }).done(function (data) {
                $("#cam-img").attr("src", data);
                $("#cam-img").css("display", "block");
                $("#h3-img-loading").css("display", "none");
            });
        });
        $("#arm-alarm").click(function () {
            $.ajax({
                url: 'controller/alarmon.php',
                type: 'POST'
            }).done(function (data) {

            });
        });
        $("#sub-topics").click(function () {
            if ($("#customCheck1").prop("checked")) {
                subToMqtt($("#customCheck1").val())
            }
            if ($("#customCheck2").prop("checked")) {
                subToMqtt($("#customCheck2").val())
            }
        });
        $("#pub-topics").click(function () {
            pubToMqtt('alarm')
        });
        $("#logout").click(function () {
            logout()
        });
        function subToMqtt(theTopic) {
            $.ajax({
                url: 'controller/sub.php',
                type: 'POST',
                data: {
                    topic: theTopic
                }
            }).done(function (data) {
                //nothing
            });
        }

        function pubToMqtt(theTopic) {
            $.ajax({
                url: 'controller/pub.php',
                type: 'POST',
                data: {
                    topic: theTopic
                }
            }).done(function (data) {
                //nothing
            });
        }
        function logout() {
            $.ajax({
                url: 'controller/logout.php',
                type: 'POST'
            }).done(function (data) {
                window.location.replace("view/login.html");
            });
        }
    </script>
</body>

</html>