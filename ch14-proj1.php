<?php
include 'includes/travel-config.inc.php';

// Handle filters
$continent = $_GET['continent'] ?? '0';
$country = $_GET['country'] ?? '0';
$title = $_GET['title'] ?? '';

// Build WHERE clause
$where = [];
$params = [];

if ($continent !== '0') {
    $where[] = "ct.ContinentCode = ?";
    $params[] = $continent;
}

if ($country !== '0') {
    $where[] = "c.ISO = ?";
    $params[] = $country;
}

if (!empty($title)) {
    $where[] = "i.Title LIKE ?";
    $params[] = "%$title%";
}

$whereClause = '';
if (!empty($where)) {
    $whereClause = 'WHERE ' . implode(' AND ', $where);
}

// Fetch images
$sql = "
    SELECT i.ImageID, i.Title, i.Path, i.Exif, i.Colors
    FROM imagedetails i
    JOIN countries c ON i.CountryCodeISO = c.ISO
    JOIN continents ct ON c.Continent = ct.ContinentCode
    $whereClause
";
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
