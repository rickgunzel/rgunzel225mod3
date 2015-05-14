<?php


function validateOrder()
{
    
    $validOrder = true;
    $firstName= $_REQUEST['fName'];
    $lastName = $_REQUEST['lName'];
    $email = $_REQUEST['email'];
    
    
    echo '<div>';
    
    // do not use the empty function since  0 is considered empty
    if ($lastName=="" || $firstName=="")
    {   
        echo'<h1 class="errors">The following errors were found when submitting your form. Please click the browsers back button to fix your errors.<h1>';
        echo '<p><h3 class="error">You did not fill in your name correctly</h3></p>'.'<br/>';
        $validOrder=false;
        
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo'<h1 class= "errors">The following errors were found when submitting your form. Please click the browsers back button to fix your errors.<h1>';
        echo '<p><h3 class="error">This is not a valid Email Address</h3></p>'.'<br/>';
        $validOrder = false;
    }
    echo '</div>';
    
    return $validOrder;
    
              
   
    
}






