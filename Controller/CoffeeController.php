<?php
require ("Model/CoffeeModel.php");

//Contains non-database related function for the Coffee page
class CoffeeController
{
    function CreateCoffeeDropdownlist()
    {
        $coffeeModel = new CoffeeModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($coffeeModel->GetCoffeeTypes()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArry )
    {
        $result = "";

        foreach ($valueArry as $value)
        {
            $result = $result . "<option value = '$value'>$value</option>";
        }

        return $result;
    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    function CreateCoffeeTables($types)
    {
        $coffeeModel = new CoffeeModel();
        $coffeeArray = $coffeeModel->GetCoffeeByType($types);
        $coffeeModel->console_log($coffeeArray);
        $coffeeModel->console_log($types);

        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($coffeeArray as $key => $coffee)
        {
            $result = $result .
                    "<table class = 'coffeeTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$coffee->image' /></th>
                            <th width = '75px' >Name: </th>
                            <td>$coffee->name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$coffee->type</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$coffee->price</td>
                        </tr>
                        
                        <tr>
                            <th>Roast: </th>
                            <td>$coffee->roast</td>
                        </tr>
                        
                        <tr>
                            <th>Origin: </th>
                            <td>$coffee->country</td>
                        </tr>
                        
                        <tr>
                            <td colspan='2' >$coffee->review</td>
                        </tr>                      
                     </table>";
        }
        return $result;
    }
    //<editor-fold desc="Set Methods">
    function InsertCoffee() {}

    function UpdateCoffee($id) {}

    function DeleteCoffee($id) {}

    //<editor-fold desc="Get Methods">
    function GetCoffeeById($id) {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeById($id);
    }

    function GetCoffeeByType($type) {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeByType($type);
    }

    function GetCoffeeTypes() {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeTypes();
    }
    //<editor-fold>
}

?>