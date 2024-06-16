<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Products from PostgreSQL Database using PG extension</h2>

    <?php
    $connection = pg_connect("host=localhost dbname=webapp user=postgres password=0000");
    ?>
</body>
</html>