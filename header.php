<?php
session_start();
require 'fonctions.php';

if (!$_SESSION["checkTracker"]) {

    $ip= $_SERVER['REMOTE_ADDR'];
    $device = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION["checkTracker"] = true;

    //Vérifie si l'ip existe dans la db
    $connection = connectDB();
    $trackingQueryPrepared = $connection->prepare("SELECT * FROM ".PRE."tracking WHERE ipAddress=:ip");
    $trackingQueryPrepared->execute(["ip"=>$ip]);
    $tracking = $trackingQueryPrepared->fetch();

    if (empty($tracking)) {
        $trackingQueryPrepared = $connection->prepare("INSERT INTO ".PRE."Tracking (ipAddress, device) VALUES (:ip, :device) ;");
        $trackingQueryPrepared->execute(["ip"=>$ip, "device"=>$device]);
    }
}

$time = date("Y-m-d H:i:s");
$ip= $_SERVER['REMOTE_ADDR'];
$connection = connectDB();
$dateQueryPrepared = $connection->prepare("UPDATE ".PRE."tracking SET `lastConnect`=:time WHERE ipAddress=:ip;");
$dateQueryPrepared->execute(["time"=>$time, "ip"=>$ip]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="assets/pictures/logo.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login_register.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yfile6GSYGSHk7tPXikynS7ogEvDej/m4="  </script> -->

    <title>Lotte</title>
</head>


