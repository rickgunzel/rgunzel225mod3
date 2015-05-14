
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        function calcSummary($width,$height) {
       
        echo '<div id="table">';
        echo '<center><br><h3>Total Area, Gallons, Hours for each Wall</h3></center>';
        echo '<table border="1"> ';
        echo '<th> Wall </th>';
        echo '<th> Width </th>';
        echo '<th> Height </th>';
        echo '<th> Area </th>';
        echo '<th> Gallons </th>';
        echo '<th> Hours </th>';
    
        $rates = array('PROFESSIONAL'=>17.50,'REGULAR'=>12.50);
        $types = array('FLAT'=>24.00,'SATIN'=>31.50,'GLOSS'=>27.75);

        DEFINE('COVERAGE',310);
        DEFINE('TIME',8);

        $index=0;
        $totalArea=0;
        $totalTime=0;
        $totalGal = 0;
    require ('connect.php'); // Connect to the db.

		// Make the query:
		
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
    
    echo '<center>'
    . '<h3>Overview of Paint Jobs</h3></center>';
     echo '<table border="1"> ';
        echo '<th> Type</th>';
        echo '<th> Labor </th>';
        echo '<th> Paint Type</th>';
        echo '<th> Paint Cost</th>';
        echo '<th> Total Price </th>';
       
        
        
        
        foreach( $rates as $key => $value){
            
            
            foreach($types as $key2=> $value2){
                $totalCost=round($value*round($totalTime),2)+$value2*ceil($totalGal);
                echo '<tr><td> '.$key.'</td>';
                echo '<td> '.number_format($value*round($totalTime),2).'</td>';
                echo '<td> '.$key2.'</td>';
                echo '<td> '.number_format($value2*ceil($totalGal),2).'</td>';
                echo '<td> '.number_format($totalCost,2).'</td></tr>';
             
        
            }
        }
    echo '</table>';
    echo '<br><br>';
    
    
    echo '</div>';
        
}

    ?>
    </body>
</html>
