<?php
    //comment
    /*
    *multi line comment
    */

    //print
    echo "Hello World!";

    //variables
    $name = "Louay";
    $age = 22;
    echo $name; //prints Louay
    //to concatenate use (.) 

    //conditional
    if ($age > 18) {
        echo "Adult";
    } else if ($age < 18 && $age >= 13){
        echo "Teenager";
    } else {
        echo "Kid";
    }

    //for loop
    for($i = 0; $i <= 5; $i++){
        echo "The number is: ".$i."\n";
    }

    //array
    $names=["n1", "n2", "n3"];
    echo $names[1];

    //function
    function testing(){
        echo "Test";
    }

    testing();

    ?>