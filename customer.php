
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1 id='title'>PETES PAINT CONFIRMATION<h1>
        <?php
        include ('phpValidation.php');
        $validOrder = validateOrder();
        // put your code here
        include_once("calcFunction.php");
        include_once("header.php");
        
        if($validOrder ==true){
            
        $firstName=$_REQUEST['fName'];
        $lastName=$_REQUEST['lName'];
        $email=$_REQUEST['email'];        
        $selectJob=$_REQUEST['jobType'];
        $selectPaint=$_REQUEST['paintType'];
        $selectColor=$_REQUEST['color'];
        
        $rates = array('PROFESSIONAL'=>17.50,'REGULAR'=>12.50);
        $types = array('FLAT'=>24.00,'SATIN'=>31.50,'GLOSS'=>27.75);
        
        $width = explode(',', $_REQUEST['theWidths']);
        $height = explode(',', $_REQUEST['theHeights']);


        $index=0;
        
        echo '<div>';
        echo '<br/>';
        echo '<p class="thanks"> Thank you <b>'.$firstName.'</b>'.' '.'<b>'.$lastName.'</b> your order has been processed. Please Review your Information. <b>'.'</p>';
        
        echo '<p> FIRST NAME:  <b>'. $firstName .'</p>';
        echo '<p> LAST NAME:  <b>'.$lastName.'</p>';
        echo '<p> EMAIL:  <b>'.$email.'</p>';
        
        echo '<p> JOB TYPE:  <b>'.$selectJob.'</p>';
        echo '<p> PAINT TYPE:  <b>'.$selectPaint.'</p>';
        echo '<p> PAINT COLOR:  <b>'.$selectColor.'</p>';
        echo '<br/>';
        echo'</div>';
        
            
   
        echo '<div id="table">';
        echo '<center><br><h3>Total Area, Gallons, Hours for each Wall</h3></center>';
        echo '<table border="1"> ';
        echo '<th> Wall </th>';
        echo '<th> Width </th>';
        echo '<th> Height </th>';
        echo '<th> Area </th>';
        echo '<th> Gallons </th>';
        echo '<th> Hours </th>';
    
        

        DEFINE('COVERAGE',310);
        DEFINE('TIME',8);

        $index=0;
        $totalArea=0;
        $totalTime=0;
        $totalGal = 0;
        
    foreach ($width as $key => $value) {
        $index++;
        foreach ($height as $key2 => $value2) {
            if($key == $key2){
        
                $area=$value*$value2;
                $gallons=$area/COVERAGE;
                $hours=$gallons*TIME;
                $totalTime+=$hours;
                $totalGal+=$gallons;
                $totalArea+=$area;
                echo '<tr><td> '.$index.'</td>';
                echo '<td> '.$value.'</td>';   
                echo '<td> '.$value2.'</td>';
                echo '<td> '.$area.'</td>';
                echo '<td> '.round($gallons,2).'</td>';
                echo '<td> '.round($hours,2) .'</td></tr>';
              
            }  
        } 
   
    }
         echo'<tr><td></td>';
                echo '<td></td>';
                echo '<td>TOTAL</td>';
                echo '<td>'.$totalArea.'</td>';
                echo '<td>'.round($totalGal,2).'</td>';
                echo '<td>'.round($totalTime,2).'</td></tr>';
        echo '</table>';
        
                        echo '<br/>';

        foreach( $rates as $key => $value){
                   
                    
            foreach($types as $key2=> $value2){
                
         
                if ($selectJob == $key && $selectPaint ==$key2){
                
                
                    $totalCost=round($value*round($totalTime),2)+$value2*ceil($totalGal);
                    echo '<p>Thank you <b>'.$firstName.'</b>'.' '.'<b>'.$lastName.'</b> your order has been processed. <b>'.$selectJob.' labor cost will be <b>$'.number_format($value*round($totalTime),2).'</b> and the paint cost will be <b>$'.number_format($value2*ceil($totalGal),2).'</b> for a total cost of <b>$'.number_format($totalCost,2).'</p>';
                }
            }
        
        }
        
        $totalGals=ceil($totalGal);
	require ('connect.php');
     

	$q = "INSERT INTO customer (first, last, email) VALUES ('$firstName', '$lastName', '$email')";		
		
        $r = mysqli_query ($dbc, $q);
        
        if ($r){
            echo '<p>Customer Successfully added to Database</p>';
        }else{
            echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
        }
        
        $q="INSERT INTO quote (custId,typeJob,typePaint,color,time,gallons,area,totalCost)"
                . " VALUES(LAST_INSERT_ID(),'$selectJob','$selectPaint','$selectColor','$totalTime','$totalGals','$totalArea','$totalCost')";
	$r1 = mysqli_query ($dbc, $q);
        $quoteId=mysqli_insert_id($dbc);
        
        if ($r1){
            echo '<p>Quote Successfully added to Database</p>';
        }else{
            echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
        }
       
        foreach ($width as $key => $value) {
            
            foreach ($height as $key2 => $value2) {
                if ($key == $key2){
                $q="INSERT INTO wall (quoteId,length,width)"
                    . " VALUES('$quoteId','$value2','$value')";
                $r = mysqli_query($dbc, $q);
                
                }
            }
            
        }
        if ($r){
            echo '<p>Walls Successfully added to Database</p>';
        }else{
            echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
        }   
        mysqli_close($dbc);
    } //end $validOrder boolean
        
        ?>
        <form  action ="quotes.php">
       
        <?php
            if ($validOrder==true){
            echo '<input type="submit" value ="See Quotes" name="quote"/>';
            }
        ?>
     
        </form>
        <form  action ="PetesPaint.php">
       
        <?php
            if ($validOrder==true){
            echo '<input type="submit" value ="Enter Another Quote" name="home"/>';
            echo '<br/>';
            echo '</div>';
            }
        ?>
     
    </form>
         
    </body>
</html>
