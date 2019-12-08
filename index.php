<?php
    session_start();
    include 'api.php';
    if(!ValidateSession()){
        header("Location: login.html"); 
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
    </style>
</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="take-photo" class="btn btn-primary btn-custom" type="button">Take Pic</div>
                <br>
                <h3 style="display:none;" id="h3-img-loading" style="color: red;">Please Wait. Your image is loading...
                </h3>
            </div>
            <br><br>
            <div class="col-12">
                <img style="display:none" id="cam-img" width="100%" height="auto" src="">
            </div>
            <br><br>
            <div class="col-12">
                <div id="arm-alarm" class="btn btn-primary btn-custom" type="button">Set Alarm On</div>
            </div>
            <br><br>

        </div>
        <div class="row">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" value="alarm">
                <label class="custom-control-label" for="customCheck1">Alarm</label>
            </div>
        </div>
        <div class="row">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck2" value="distance">
                <label class="custom-control-label" for="customCheck2">Distance</label>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="sub-topics" class="btn btn-primary btn-custom" type="button">Subscribe to topics</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="pub-topics" class="btn btn-primary btn-custom" type="button">Publish to topics</div>
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
                url: '/pic.php',
                type: 'POST'
            }).done(function (data) {
                var homeurl = window.location.href.replace('index.php','');
                $("#cam-img").attr("src", homeurl + data);
                $("#cam-img").css("display", "block");
                $("#h3-img-loading").css("display", "none");
            });
        });
        $("#arm-alarm").click(function () {
            $.ajax({
                url: '/alarmon.php',
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
            if ($("#customCheck1").prop("checked")) {
                pubToMqtt($("#customCheck1").val())
            }
            if ($("#customCheck2").prop("checked")) {
                pubToMqtt($("#customCheck2").val())
            }

        });

        function subToMqtt(theTopic) {
            $.ajax({
                url: '/sub.php',
                type: 'POST',
                data: {
                    topic: theTopic
                }
            }).done(function (data) {
                alert(data)
            });
        }
        function pubToMqtt(theTopic) {
            $.ajax({
                url: '/pub.php',
                type: 'POST',
                data: {
                    topic: theTopic
                }
            }).done(function (data) {
                //alert(data)
            });
        }
    </script>
</body>

</html>