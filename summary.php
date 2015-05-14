
<?php

$page_title = "Petes Paints Estimates";
include ('header.php');
include ('phpValidation.php');
?>

        <?php
            include_once("calcFunction.php");
  
            $width = array();
            $height = array();
            $totalValue = 0;

            echo '<h1 id="title">PETES PAINT ESTIMATES</h1>';

            $width = explode(',', $_REQUEST['finalWidths']);
            $height = explode(',', $_REQUEST['finalHeights']);

            $totalValue = calcSummary($width,$height);
            
            
        ?>
        <div>    
        <form action="customer.php" method="post">
        
        
        
        <h1>Please Add Contact Information</h1>
        First Name:
        <input type="text" id ="fName"  name="fName" />
        
        Last Name:
        <input type="text" id ="lName"  name="lName" />
        
        Email:
        <input type="text" id ="email"  name="email" />
        <br />
        
        
        <br />
        
        <br /><br />
  

            <?php
            $rates = array('PROFESSIONAL'=>17.50,'REGULAR'=>12.50);
            $types = array('FLAT'=>24.00,'SATIN'=>31.50,'GLOSS'=>27.75);
            $paintType = array('BLUE','YELLOW','GREEN','WHITE','TAN' ,'RED'); 
            
          
            $index = 0;
            echo'<select name="jobType">';
                foreach ($rates as $key => $value) {
                    echo '<option value="' . $key .'">' . $key.'</option>';
                    $index++;
                  
                }
            echo'</select>';    
            echo'<select name="paintType">';    
                 foreach ($types as $key2 => $value2) {
                    echo '<option value="' . $key2 .'">' . $key2.'</option>';
                    $index++;
                  
                }
            echo'</select>';    
            echo'<select name="color">';    
                foreach ($paintType as $key3 => $value3) {
                    echo '<option value="' . $value3 .'">' . $value3.'</option>';
                    $index++;
                  
                }  
            echo'</select>';        
            
                $single_widths = implode(',', $width);
                $single_heights = implode(',', $height);
                // Note: you need to make certain that the comma is passed instead of
                //interpreted, so use the htmlspecialchars() function
                
                
                
                echo '<input type="hidden" name="theWidths" value="' . htmlspecialchars($single_widths) . '">';
                echo '<input type="hidden" name="theHeights" value="' . htmlspecialchars($single_heights) . '">';
            ?>
            <input type="submit" value="Submit me!" />
            <br/>
            <br/>
            
          
            
        </form>
            
        </div>
   
    