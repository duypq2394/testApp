<?php

require ("Entities/CoffeeEntity.php");

//Contains database related code for the Coffee page.
class CoffeeModel
{
    //Get all cofee types from the database and return them in an array.
    function GetCoffeeTypes()
    {
        require 'Credentials.php';

        //Open connection and Select database.
        $con = mysqli_connect($host,$user,$passwd);
        mysqli_select_db($con, $database) or die(mysqli_error($con));
        $result = mysqli_query($con, "SELECT DISTINCT type FROM coffee") or die(mysqli_error($con));
        $types = array();

        //Get data from database.
        while($row = mysqli_fetch_array($result))
        {
            array_push($types, $row[0]);
        }

        //Close connection and return result
        //mysqli_free_result($result);
        mysqli_close($con);
        return $types;
    }

    function GetCoffeeByType($type)
    {
        require 'Credentials.php';

        //Open connection and Select database.
        $con = mysqli_connect($host,$user,$passwd);
        mysqli_select_db($con, $database) or die(mysqli_error($con));

        $query = "SELECT * FROM coffee WHERE type LIKE '$type'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $coffeeArray = array();

        //Get data from database.
        while($row = mysqli_fetch_array($result)){
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $roast = $row[4];
            $country = $row[5];
            $image = $row[6];
            $review = $row[7];

            //Create coffee objects and store them in an array.
            $coffee = new CoffeeEntity ($id, $name, $type, $price, $roast, $country, $image, $review);
            array_push($coffeeArray, $coffee);
        }

        //Close connection and return result
        //mysqli_free_result($result);
        mysqli_close($con);
        return $coffeeArray;
    }

    function GetCoffeeById($id)
    {
        require 'Credentials.php';

        //Open connection and Select database.
        $con = mysqli_connect($host,$user,$passwd);
        mysqli_select_db($con, $database) or die(mysqli_error($con));

        $query = "SELECT * FROM coffee WHERE id = $id";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        //Get data from database.
        while($row = mysqli_fetch_array($result)){
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $roast = $row[4];
            $country = $row[5];
            $image = $row[6];
            $review = $row[7];

            //Create coffee 
            $coffee = new CoffeeEntity ($id, $name, $type, $price, $roast, $country, $image, $review);
        }

        //Close connection and return result
        //mysqli_free_result($result);
        mysqli_close($con);
        return $coffee;
    }

    function InsertCoffee(CoffeeEntity $coffee){
        require 'Credentials.php';

        //Open connection and Select database.
        $con = mysqli_connect($host,$user,$passwd);
        mysqli_select_db($con, $database) or die(mysqli_error($con));

        //Define query
        $query = sprintf("INSERT INTO coffee
                          (name, type, price, roast, country, image, review )
                          VALUES
                          ('%s','%s','%s','%s','%s','%s','%s')",
        mysqli_real_escape_string($con, $coffee->name),
        mysqli_real_escape_string($con, $coffee->type),
        mysqli_real_escape_string($con, $coffee->price),
        mysqli_real_escape_string($con, $coffee->roast),
        mysqli_real_escape_string($con, $coffee->country),
        mysqli_real_escape_string($con, "Images/Coffee/".$coffee->image),
        mysqli_real_escape_string($con, $coffee->review));

        //Execute query and close connection
        mysqli_query($con, $query) or die(mysqli_error($con));
        mysqli_close($con);
    }
    
    function UpdateCoffee($id, CoffeeEntity $coffee){
        require 'Credentials.php';

        //Open connection and Select database.
        $con = mysqli_connect($host,$user,$passwd);
        mysqli_select_db($con, $database) or die(mysqli_error($con));

       //Define query
       $query = sprintf("UPDATE coffee 
                            SET name = '%s', type = '%s',price = '%s',roast = '%s',
                            country = '%s', image = '%s',review = '%s'
                            WHERE id = $id",
        mysqli_real_escape_string($con, $coffee->name),
        mysqli_real_escape_string($con, $coffee->type),
        mysqli_real_escape_string($con, $coffee->price),
        mysqli_real_escape_string($con, $coffee->roast),
        mysqli_real_escape_string($con, $coffee->country),
        mysqli_real_escape_string($con, "Images/Coffee/".$coffee->image),
        mysqli_real_escape_string($con, $coffee->review));

        //Execute query and close connection
        mysqli_query($con, $query) or die(mysqli_error($con));
        mysqli_close($con);
    }

    function DeleteCoffee($id){
        require 'Credentials.php';

        //Open connection and Select database.
        $con = mysqli_connect($host,$user,$passwd);
        mysqli_select_db($con, $database) or die(mysqli_error($con));

        //Define query
        $query = "DELETE FROM coffee WHERE id = $id";

        //Execute query and close connection
        mysqli_query($con, $query) or die(mysqli_error($con));
        mysqli_close($con);
    }

    // function PerformQuery($query)
    // {
    //     require 'Credentials.php';

    //     //Open connection and Select database.
    //     $con = mysqli_connect($host,$user,$passwd);
    //     mysqli_select_db($con, $database) or die(mysqli_error($con));

    //     //Execute query and close connection
    //     mysqli_query($con, $query) or die(mysqli_error($con));
    //     mysqli_close($con);
    // }
}

?>