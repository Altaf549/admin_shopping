<?php
// Test database connection
$config = [
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'shopping_db',
];

$conn = new mysqli($config['hostname'], $config['username'], $config['password']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to MySQL successfully.\n";

// Check if database exists
$result = $conn->query("SHOW DATABASES LIKE 'shopping_db'");
if ($result->num_rows > 0) {
    echo "Database 'shopping_db' exists.\n";
    
    // Select the database
    $conn->select_db('shopping_db');
    
    // Check if users table exists
    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows > 0) {
        echo "Table 'users' exists.\n";
        
        // Check if there are any users
        $users = $conn->query("SELECT * FROM users LIMIT 1");
        if ($users->num_rows > 0) {
            echo "Found " . $users->num_rows . " user(s) in the database.\n";
            print_r($users->fetch_assoc());
        } else {
            echo "No users found in the database.\n";
        }
    } else {
        echo "Table 'users' does not exist.\n";
    }
} else {
    echo "Database 'shopping_db' does not exist.\n";
}

$conn->close();
