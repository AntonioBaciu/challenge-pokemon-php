<?php
 // Pokemon API
if (!empty($_GET['name'])) { // gets the input value
    $poke_url = 'https://pokeapi.co/api/v2/pokemon/' . urlencode($_GET['name']); // url api
    $poke_json = file_get_contents($poke_url); // gets api & species
    $poke_array = json_decode($poke_json, true); // converts api to array

    // Gets Pokemon info
    $name = $_GET['name'];
    $poke_name = $poke_array['name']; 
    $poke_id = $poke_array['id'];

    // Stats                   /////////// FIX THE STATS ///////////// AND RANDOMIZE THE MOVES ///// AND ADD TEXT FOR THE DEFAULT IMG & SHINY IMG
    // $poke_hp = $poke_array['stats'][0]['base_stat']; 
    // var_dump($poke_hp);
    // $poke_dmg = $poke_array['stats']['base_stat']; // attack
    // $poke_def = $poke_array['stats']['base_stat'];
    // $poke_special = $poke_array['stats']['base_stat']; // special attack
    // $poke_special_def = $poke_array['stats']['base_stat']; // special defense
    // $poke_spd = $poke_array['stats']['base_stat']; // speed

    // Gets img default & shiny
    $poke_img_front = $poke_array['sprites']['front_default'];
    $poke_img_back = $poke_array['sprites']['back_default'];
    $poke_img_front_shiny = $poke_array['sprites']['front_shiny'];
    $poke_img_back_shiny = $poke_array['sprites']['back_shiny'];

    // Gets moves
    for ($i = 0; $i <= 5; $i++) {
    $poke_moves = $poke_array['moves'][$i]['move']['name'];
    }

    // Evolutions API
    $poke_species_url = 'https://pokeapi.co/api/v2/pokemon-species/' . urlencode($_GET['name']); // url species 
    $poke_json_species = file_get_contents($poke_species_url);
    $poke_array_species = json_decode($poke_json_species, true); // converts species to array

    // Gets evolution info
    $poke_habitat = $poke_array_species['habitat'];
    $poke_growth = $poke_array_species['growth_rate']['name'];
    
        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pokedex PHP</title>
</head>
<body>
   
    <!-- Pokemon Info -->
    <div class="main-wrap">
        <!-- Input  -->
        <div class="input-wrap">
            <form action="" method="get">
                Pokemon Name/ID: <input type="text" name="name"> <br/>
                <input type="submit" value="Submit"> <br/>
            </form>
        </div>

        <!-- Name - ID - prev evolution - habitat-->
        <div class="info-wrap">
            <div class="name"> <!-- Pokemon name -->
                <?php 
                if (isset($_GET['name'])) 
                { echo "Name: {$poke_name}";}
                ?>
            </div>

            <div class="id"> <!-- Pokemon id -->
                <?php 
                if (isset($_GET['name'])) 
                { echo "Id: #{$poke_id}";}
                ?>
            </div> 
            
            <div class="evo">
                <?php 
                    if (isset($_GET['name'])) 
                    { // Check if previous evolution exists
                    if($poke_array_species["evolves_from_species"] === null) {
                        $no_evolution = "No previous evolution";
                        echo $no_evolution;
                    } else {
                        $previous_evolution = "Previous Evolution: " . $poke_array_species["evolves_from_species"]["name"];
                        echo $previous_evolution;
                    }
                    }
                    ?>
            </div>

            <div class="evo"> <!-- Habitat -->
                <?php 
                    if (isset($_GET['name'])) {
                        if($poke_habitat !== null) { 
                            echo "Habitat: {$poke_habitat['name']}";
                        }else {
                            echo "Habitat: Unknown";
                        }
                    }
                ?>
            </div>
            
            <div class="evo"> <!-- Growth Rate -->
                <?php 
                if (isset($_GET['name'])) 
                { echo "Growth rate: {$poke_growth}";}
                ?>
            </div>

        </div>

        <!-- Pokemon img --> 
        <div class="img-wrap">
            <!-- img front --> 
            <img src="
                <?php 
                if (isset($_GET['name'])) 
                { echo $poke_img_front;} 
            ?>">

            <!-- img back --> 
            <img src="
                <?php 
                if (isset($_GET['name'])) 
                { echo $poke_img_back;} 
            ?>">

            <!-- img front shiny --> 
            <img src="
                <?php 
                if (isset($_GET['name'])) 
                { echo $poke_img_front_shiny;} 
            ?>">

            <!-- img back shiny --> 
            <img src="
                <?php 
                if (isset($_GET['name'])) 
                { echo $poke_img_back_shiny;} 
            ?>">
        </div>

        <!-- Pokemon moves -->
        <div class="moves-wrap">
            <div class="moves">  
                <?php 
                    if (isset($_GET['name'])) { 
                        for ($i = 0; $i <= 5; $i++) {
                        $poke_moves = $poke_array['moves'][$i]['move']['name'];
                        echo $poke_moves . ' ';
                        } 
                    }
                ?>
                </div>
        </div>
    </div>
</body>
</html>