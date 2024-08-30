<?php
$host = "localhost";
$username = "root";
$pass = "";
$database = "Hospital";

$connection = mysqli_connect($host, $username, $pass, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM PATIENT";
$query = mysqli_query($connection, $sql);

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Patient List </h2>

<table border="1">

    <thead>
    
    <tr>
            <th>Number</th>
            <th>Patient's Name</th>
            <th>Email</th>
            <th>Date</th>
        </tr>
   
    </thead>
   
    <tbody>
   
<?php

        if ($query)
         {
            while ($row = mysqli_fetch_assoc($query))
             {
                echo "
                <tr>
            <td>" . htmlspecialchars($row['id']) . "</td>
         <td>" . htmlspecialchars($row['name']) . "</td>
     <td>" . htmlspecialchars($row['email']) . "</td>
      <td>" . htmlspecialchars($row['date']) . "</td>
      </tr>";
            
    }
    
} 
else

{

    echo "Error occurred";

}

        
?>

    </tbody>

</table>

</body>
</html>
