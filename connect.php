<?php
// Login & Session example by sde
// connect.php

// Set the database access information as constants:
DEFINE ('DB_USER', 'itp225');
DEFINE ('DB_PASSWORD', 'itp225');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'petespaint');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

?> 