<!DOCTYPE HTML>

<?php   
$page_title = "Petes Paint"; 
include ('header.php');

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Pete's Paint</title>

    </head>
    <body>
    <?php
    
        $width= array();
        $height= array();
       
      
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $width = explode(',', $_POST['theWidth']);
            $height = explode(',', $_POST['theHeight']);
           
            if ($width[0] == "" && $height[0] == "") {
                unset($width[0]);
                unset($height[0]);
                $width = array_values($width);
                $height = array_values($height);
            }
         
            if (is_numeric($_POST['width']) && is_numeric($_POST['height'])) {
                $newWidth = $_POST['width'];
                $newHeight = $_POST['height']; 
                array_push($width, $newWidth);
                array_push($height, $newHeight);
            } else {
                echo ' Not valid input!';
            }
            
            
        }
        
    ?>

    <h1 id='title'>PETES PAINT</h1>
    <form action="PetesPaint.php" method="post">
        <div class='dimensions'>
        <h1>Enter Dimensions</h1>
        Width:
        <input type="text" id ="width"  name="width" align ="left"/>
        <br />
        Height:
        <input type="text" id ="height"  name="height" align ="left"/>
        <br />
        <input type ="submit" value="Add Wall" name ="addIt" />
        
        <br /> <br />
        </div>
        
        <div>
        <form method="get" action="customer.php"  >  
        Current Walls:

        <?php
          
            echo'<select name="currentWalls">';
          
            $index = 0;
            
           
            foreach ($width as $key => $value) {
                $d1 =$width[$index];
                foreach ($height as $key => $value) {
                    $d2 =$height[$index];
                }    
                echo '<option value="' . $index .'">' . 'Wall--' . ($index + 1) . ' Width: ' . $d1 . ' Height: '. $d2 .'</option>';
                    $index++;
               
                    
            }    
            
          
            echo'</select>';
           
            $widths = implode(',', $width);
            $heights= implode(',', $height);
            echo '<input type="hidden" name="theWidth" value="' . htmlspecialchars($widths) . '">';
            echo '<input type="hidden" name="theHeight" value="' . htmlspecialchars($heights) . '">';
            
        ?>
            </form>
            
        
        <br /> <br />
        
    </form>
    <form  action ="summary.php">
        
        <input type="hidden" name ="finalWidths" value ="<?php echo htmlspecialchars($widths) ?> ">
        <input type="hidden" name ="finalHeights" value ="<?php echo htmlspecialchars($heights) ?> ">
        <?php
            if ($widths > 0){  
                echo '<input type="submit" value ="summary page" name="summary"/>';
                
            }
        ?>
     
    </form>

    </div>
        

</body>
</html>


