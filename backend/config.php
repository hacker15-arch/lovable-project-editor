<?php
// backend/config.php

// Define MySQL connection parameters
define('DB_HOST', 'localhost');
define('DB_NAME', 'renthome');
define('DB_USER', 'root');
define('DB_PASS', '');

// Optionally, set options for PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
];
?>
