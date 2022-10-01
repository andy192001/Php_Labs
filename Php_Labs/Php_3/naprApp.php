<?php
    $filePath = "napr.txt";
    $file = fopen($filePath, 'r');

    $naprArr = array();
    while(!feof($file)){
        array_push($naprArr, fgets($file));
    }
    sort($naprArr);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="dataApp.php" method="post">
    
        <?php foreach ($naprArr as $napr): ?>
            <input type="radio" value="<?php echo $napr; ?>" name="directions" ><?php echo $napr; ?> <br>
        <?php endforeach; ?>
        <input type="submit" value="Відправити">

    </form>
</body>
</html>