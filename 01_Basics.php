<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php tutorial</title>
</head>
<body>
    <div class="container">
        This is my first php website 
        <?php
        define ('PI',3.14);
        echo "Hello world and this is printed using php";
        //single line comment 
        /*
        This 
        is 
        a 
        multiline
        comment

        */
        $variable1=5;
        $variable2=2;
        echo $variable1;
        echo  $variable2;
        echo $variable1 + $variable2;
        //operators in php
        //arithmetic Operator 
        echo "The value of variable1 and variable2 is ";
        echo "<br>";
        echo $variable1 + $variable2;
         echo "<br>";
          echo "The value of variable1 and variable2 is ";
        echo "<br>";
        echo $variable1 + $variable2;
         echo "<br>"; echo "The value of variable1 - variable2 is ";
        echo "<br>";
        echo $variable1 - $variable2;
         echo "<br>"; echo "The value of variable1 / variable2 is ";
        echo "<br>";
        echo $variable1 / $variable2;
         echo "<br>";
          echo "The value of variable1 * variable2 is ";
        echo "<br>";
         echo "<br>";
         $newvar=$variable1;
         echo "the value of new variable is";
         echo $newvar;
          echo "<br>";
          //Assignment operator 
          $newvar *=2;
          echo "The value of new variable is ";
          echo $newvar;
           echo "<br>";
           //comparison operator 
           echo "<h1> comparison operators </h1> ";
           echo "The value of 1==4 is ";
           echo var_dump(1==4);
            echo "<br>";
           
           echo "The value of 1!=4 is ";
           echo var_dump(1!=4);
            echo "<br>";

           echo "The value of 1>=4 is ";
           echo var_dump(1>=4);
            echo "<br>";
           
           echo "The value of 1<=4 is ";
           echo var_dump(1<=4);
            echo "<br>";
            //increment /decrement operators 
           echo $variable1++;
            echo "<br>";
            echo $variable1--;
             echo "<br>";
            echo ++$variable1;
             echo "<br>";
            echo --$variable1;
             echo "<br>";
             echo $variable1;
              echo "<br>";
              //logical operator 
            //   and(&&);
            //   or(||);
            //   xor;
            $myvar = (true and true);
            echo var_dump($myvar);
             echo "<br>";
             $myvar = (false and true);
              echo var_dump($myvar);
               echo "<br>";
               $myvar = (false or true);
               echo var_dump($myvar);

        ?>
          <?php
        // data types in php 
        // 1. string 
        // 2. Integer
        // 3. float 
        // 4. boolean 
        // 5. array 
        // 6. object 
        echo "<br> Data types <br> ";
        $var = "This is a string";
        echo var_dump($var);
         echo "<br>";
        $var = 67.2;
        echo var_dump($var);
        echo "<br>";
        echo PI;
        
        ?>
       
    
</div> 
</body>
</html>