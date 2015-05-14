
<?php
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1 id='title'>PETES PAINT QUOTES<h1>
        <?php
        
        include_once("header.php");
        require('connect.php');
        
        $sql='SELECT first,last,quoteId,typeJob,typePaint,color,time,gallons,area, totalCost 
            from quote join customer on quote.custId=customer.custId';
  
        $r=mysqli_query($dbc,$sql);
        
        echo '<div id="quoteDiv">';
  
        echo '<table border="1" id="quoteTable"> ';
        echo '<th> First Name</th>';
        echo '<th> Last Name</th>';
        echo '<th> QuoteId</th>';
        echo '<th> JobType </th>';
        echo '<th> PaintType </th>';
        echo '<th> Color </th>';
        echo '<th> Hours </th>';
        echo '<th> Gallons </th>';
        echo '<th> Area </th>';
        echo '<th> TotalCost </th>';
        
        while ($row = mysqli_fetch_array($r)){
        
        
                echo "<tr><td>{$row['first']}</td>";
                echo "<td>{$row['last']}</td>";
                echo "<td>{$row['quoteId']}</td>";   
                echo "<td>{$row['typeJob']}</td>";
                echo "<td>{$row['typePaint']}</td>";
                echo "<td>{$row['color']}</td>";
                echo "<td>{$row['time']}</td>";
                echo "<td>{$row['gallons']}</td>";
                echo "<td>{$row['area']}</td>";                         
                echo "<td>{$row['totalCost']}</td></tr>";
              
            
        } 
            echo'</table></div>';
            echo '<br/>';
                mysqli_close($dbc);
        
       
        ?>
        <form  action ="PetesPaint.php">
       
        <?php
            echo '<div>';
            
            echo '<input type="submit" value ="Enter Another Quote" name="quote"/>';
            echo '</div>';
        ?>
     
    </form>
         
    </body>
</html>
