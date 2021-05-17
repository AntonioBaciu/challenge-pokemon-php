<?php 
    if(isset($_GET['name'], $_GET['age'])) {
        $name = $_GET['name'];
        $age = $_GET['age'];

        echo "You are {$name} and you are {$age} years old";
    }
?> 

    <!-- <form action="index.php" method="GET">
      <input type="text" name="name" placeholder="Name" />
      <input type="text" name="age" placeholder="Age" />
      <input type="submit" />
    </form> -->

