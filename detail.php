<?php

include 'includes/travel-config.inc.php';

$imageId = $_GET['ImageID'] ?? null;

if (!$imageId || !is_numeric($imageId)) {
    die("Invalid Image ID.");
}


$sql = "
    SELECT i.ImageID, i.Title, i.Description, i.Path, i.Exif, i.Colors, i.Creator, 
           c.CountryName, ci.AsciiName AS CityName
    FROM imagedetails i
    LEFT JOIN countries c ON i.CountryCodeISO = c.ISO
    LEFT JOIN cities ci ON i.CityCode = ci.CityCode
    WHERE i.ImageID = ?
";
$stmt = $pdo -> prepare($sql);
$stmt -> execute([$imageId]);
$image = $stmt -> fetch();

if (!$image) {
    die("Image not found.");
}


$exif = json_decode($image['Exif'], true);
$colors = json_decode($image['Colors'], true);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chapter 14</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
   
    <link rel="stylesheet" href="css/styles.css" />

</head>

<body>                                    
   <main class="detail">
      <div>
         image here
      </div>
      <div>
         <h1>title here</h1>
         <h3>city, country</h3>
         <p>description</p>
         <div class="box">
            <h3>Creator</h3>

         </div>
         
         <div class="box">
            <h3>Camera</h3>

         </div>
         <div class="box">
            <h3>Colors</h3>

         </div>
      </div>
   </main>
</body>

</html>
