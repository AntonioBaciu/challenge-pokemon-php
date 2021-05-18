<?php
// Pokemon API
$search_term = 'bulbasaur';
if (!empty($_GET['name'])) {
    $search_term = $_GET['name'];
} // gets the input value
$poke_url = 'https://pokeapi.co/api/v2/pokemon/' . urlencode($search_term); // url api
$poke_json = file_get_contents($poke_url); // gets api & species
$poke_array = json_decode($poke_json, true); // converts api to array

// Gets Pokemon info
$name = $search_term;
$poke_name = $poke_array['name'];
$poke_id = $poke_array['id'];

// Stats                   
$poke_hp = $poke_array['stats'][0]['base_stat'];
$poke_dmg = $poke_array['stats'][1]['base_stat']; // attack
$poke_def = $poke_array['stats'][2]['base_stat'];
$poke_special = $poke_array['stats'][3]['base_stat']; // special attack
$poke_special_def = $poke_array['stats'][4]['base_stat']; // special defense

// Gets img default & shiny
$poke_img_front = $poke_array['sprites']['front_default'];
$poke_img_back = $poke_array['sprites']['back_default'];

// Evolutions API
$poke_species_url = 'https://pokeapi.co/api/v2/pokemon-species/' . urlencode($search_term); // url species 
$poke_json_species = file_get_contents($poke_species_url);
$poke_array_species = json_decode($poke_json_species, true); // converts species to array

// Gets evolution info
$poke_habitat = $poke_array_species['habitat'];
$poke_growth = $poke_array_species['growth_rate']['name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <title>Pokedex PHP</title>
</head>

<body>
    <div class="main-wrap">
        <div class="left">
            <!-- Left Buttons-->
            <div class="btn-wrap">
                <div class="btn-round__wrap">
                    <div class="btn-round">
                        <div class="btn-round__inner"></div>
                    </div>
                </div>
                <div class="dpad_wrap">
                    <div class="dpad_top d-btn">X</div>
                    <div class="dpad_right d-btn">Y</div>
                    <div class="dpad_bot d-btn">B</div>
                    <div class="dpad_left d-btn">A</div>
                </div>
            </div>
        </div>

        <!-- Screen Section -->
        <div class="center">
            <div class="screen">
                <div class="main_wrap">
                    <!-- Pokemon Info -->
                    <div class="inner-wrap">

                        <!-- Input  -->
                        <form action="" method="get" class="input-wrap">
                            <img class="logo" src="img/pokeball.png" alt="" />
                            <input class="search-bar" type="text" name="name"> <br />
                            <input class="button" type="submit" value="SEARCH"> <br />
                        </form>

                        <!-- Name - ID - prev evolution - habitat-->
                        <div class="info-wrap">

                            <!-- Left section -->
                            <div class="left-info">
                                <div class="name">
                                    <!-- Pokemon name -->
                                    <?php
                                    echo ucfirst($poke_name);
                                    ?>
                                </div>

                                <div class="id">
                                    <!-- Pokemon id -->
                                    <?php
                                    echo "Id: #{$poke_id}";
                                    ?>
                                </div>

                                <div class="evo">
                                    <!-- Pokemon evolution -->
                                    <?php
                                    if (
                                        $poke_array_species["evolves_from_species"] === null
                                    ) {
                                        $no_evolution = "No prev. evolution";
                                        echo $no_evolution;
                                    } else {
                                        $previous_evolution = "Previous Evolution: " . $poke_array_species["evolves_from_species"]["name"];
                                        echo $previous_evolution;
                                    }
                                    ?>
                                </div>

                                <div class="habitat">
                                    <!-- Habitat -->
                                    <?php
                                    if ($poke_habitat !== null) {
                                        echo "Habitat: {$poke_habitat['name']}";
                                    } else {
                                        echo "Habitat: Unknown";
                                    }
                                    ?>
                                </div>

                                <div class="grow">
                                    <!-- Growth Rate -->
                                    <?php
                                    echo "Growth: {$poke_growth}";
                                    ?>
                                </div>
                            </div>

                            <!-- Pokemon img -->
                            <div class="img-wrap">
                                <!-- img front -->
                                <img class="poke-img" src="
                                <?php
                                echo $poke_img_front;
                                ?>">

                                <!-- img back -->
                                <img class="poke-img" src="
                                <?php
                                echo $poke_img_back;
                                ?>">
                            </div>

                            <!-- Right Info / Stats -->
                            <div class="stats-wrap">
                                <!-- Stats -->
                                <div class="hp">
                                    <!-- HP -->
                                    <?php
                                    echo "HP <span>{$poke_hp}</span>";
                                    ?>
                                </div>

                                <div class="dmg">
                                    <!-- DMG -->
                                    <?php
                                    echo "Attack <span>{$poke_dmg}</span>";
                                    ?>
                                </div>

                                <div class="def">
                                    <!-- DEF -->
                                    <?php
                                    echo "Defense <span>{$poke_def}</span>";
                                    ?>
                                </div>

                                <div class="special-attack">
                                    <!-- Special Attack -->
                                    <?php
                                    echo "Special Attack <span>{$poke_special}<span>";
                                    ?>
                                </div>

                                <div class="special-defense">
                                    <!-- Special Defence -->
                                    <?php
                                    echo "Special Defence <span>{$poke_special_def}</span>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Pokemon moves -->
                        <div class="moves-wrap">
                            <div class="moves">
                                <?php
                                if (count($poke_array['moves']) <= 1) {
                                    $poke_moves = $poke_array['moves'][0]['move']['name'];
                                    echo $poke_moves;
                                } else {
                                    $rand_keys = array_rand($poke_array['moves'], 4);
                                    echo "<span>{$poke_array['moves'][$rand_keys[0]]['move']['name']}</span>";
                                    echo "<span>{$poke_array['moves'][$rand_keys[1]]['move']['name']}</span>";
                                    echo "<span>{$poke_array['moves'][$rand_keys[2]]['move']['name']}</span>";
                                    echo "<span>{$poke_array['moves'][$rand_keys[3]]['move']['name']}</span>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Buttons -->
        <div class="right">
            <div class="btn-wrap">
                <div class="dpad_wrap second">
                    <div class="dpad_top d-btn">X</div>
                    <div class="dpad_right d-btn">Y</div>
                    <div class="dpad_bot d-btn">B</div>
                    <div class="dpad_left d-btn">A</div>
                </div>
                <div class="btn-round__wrap">
                    <div class="btn-round">
                        <div class="btn-round__inner"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>