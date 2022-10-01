<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
<?php

use Oblast as GlobalOblast;

    class Oblast{

        public $id;
        public $name;
        public $population;
        public $university_count;

        function __construct($id,$name,$population,$university_count)
        {
            $this->id = $id;
            $this->name = $name;
            $this->population = $population;
            $this->university_count = $university_count;
        }
    }

    echo "<table border='1'>

    <tr>
    
    <th>Number</th>
    
    <th>Oblast</th>
    
    <th>Population</th>
    
    <th>University</th>

    <th>Number University 100</th>
    
    </tr>";

    $filePath = "oblinfo.txt";
    $handle = fopen($filePath, "r");

    $line = fgets($handle);
    $len = intval(preg_replace("/\D/",'', $line));
    $oblastList = array();

    for($i = 1; $i <= $len; $i++){
        $name = fgets($handle);
        $population = intval(preg_replace("/\D/",'', fgets($handle)));
        $university_count = intval(preg_replace("/\D/",'', fgets($handle)));
        array_push($oblastList, new GlobalOblast($i,$name,$population,$university_count));
    }

    // display

     for($i = 0; $i < $len; $i++){
        echo "<tr>";
        echo "<td>" . $oblastList[$i]->id ."</td>";
        echo "<td>" . $oblastList[$i]->name ."</td>";
        echo "<td>" . $oblastList[$i]->population ."</td>";
        echo "<td>" . $oblastList[$i]->university_count ."</td>";
        echo "<td>" . round(($oblastList[$i]->university_count / $oblastList[$i]->population) * 100, 2) . "</td>";
        echo "</tr>";
    }




?>
</body>
</html>