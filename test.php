<?php
session_start();
require 'fonctions.php';

header('Content-Type: application/json');

$connection = connectDB();
$queryPrepared = $connection->prepare("SELECT avg(price) AS average, MONTH(startDate) as month FROM ".PRE."ride WHERE startDate >= curdate() - interval (dayofmonth(curdate()) - 1) day - interval 11 month group by MONTH(startDate), YEAR(startDate) order by startDate");
$queryPrepared->execute();
$results = $queryPrepared->fetchALL(PDO::FETCH_ASSOC);

echo json_encode($results);