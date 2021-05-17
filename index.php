<?php
if (!empty($_GET['name'])) { // gets the input value
    $poke_url = 'https://pokeapi.co/api/v2/pokemon/' . urlencode($_GET['name']); // url + input
    $poke_json = file_get_contents($poke_url); // gets api
    $poke_array = json_decode($poke_json, true); // converts json object to array
    
    // Gets and displays the name & id
    $poke_name = $poke_array['name']; 
    $poke_id = $poke_array['id'];
    $name = $_GET['name'];
    echo "Name: {$poke_name} Id: #{$poke_id} ";

    // Gets and displays the img

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex PHP</title>
</head>
<body>
    <form action="" method="get">
        Pokemon Name/ID: <input type="text" name="name"> <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>