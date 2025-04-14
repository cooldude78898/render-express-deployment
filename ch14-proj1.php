<?php
include 'includes/travel-config.inc.php';

try (
  $continent = $_GET['continent'];
  $country = $_GET['country'];
  $imageDetails = $_GET['imagedetails'];

  $pdo = new PDO($continent, $country, $imageDetails);
  $pdo = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch images
  $sql = "
  SELECT i.ImageID, i.Title, i.Path, i.Exif, i.Colors, c.CountryCodeISO
  FROM imagedetails i
  JOIN countries c ON i.CountryCodeISO = c.ISO
  JOIN continents ct ON c.Continent = ct.ContinentCode
  ";

  $result = $pdo->query($sql);

  while ($row = $result->fetch()) {
    echo $row['ImageID']. "-". $row['Title'];
    echo "<br/>";
  }

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  $images = $stmt->fetchAll();

  // Fetch continents
  $continents = $pdo->query("SELECT ContinentCode, ContinentName FROM continents")->fetchAll();

  // Fetch countries that are in imagedetails
  $countries = $pdo->query("
  SELECT DISTINCT c.ISO, c.CountryName 
  FROM countries c
  JOIN imagedetails i ON c.ISO = i.CountryCodeISO
  ")->fetchAll();
  )

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
    <header>
        <form action="ch14-proj1.php" method="get" >
          <div class="form-inline">
          <select name="continent" >
            <option value="0">Select Continent</option>
          </select>     
          
          <select name="country">
            <option value="0">Select Country</option>
          </select>    
          <input type="text"  placeholder="Search title" name=title>
          <button type="submit" class="btn-primary">Filter</button>
          <button type="submit" class="btn-secondary">Reset</button>
          </div>
        </form>
    </header>   
                                    
    <main >
        <ul >

            <li>
                link+img here
            </li>        

          </ul>       

      
      </main>

</body>

</html>
