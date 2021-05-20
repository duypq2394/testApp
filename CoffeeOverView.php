<?php
$title = "Manage coffee objects";
include './Controller/CoffeeController.php';
$coffeeController = new CoffeeController();

$content = $coffeeController->CreateOverViewTable();

if(isset($_GET["delete"]))
{
    $coffeeController->DeleteCoffee($_GET["delete"]);
}
include './Template.php';      
?>
