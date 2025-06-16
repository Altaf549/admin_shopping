<?php
// This is a one-time script to create/reset an admin user
// Access this script directly in your browser and then DELETE it immediately after use

// Load CodeIgniter
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Get database configuration
$config = config('Database');

// Create database connection
$db = \Config\Database::connect($config->default);

// Admin user data
$username = 'admin';
$email = 'admin@example.com';
$password = 'admin123'; // Change this to a secure password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if user exists
$user = $db->table('users')->where('username', $username)->get()->getRowArray();

if ($user) {
    // Update existing user
    $db->table('users')
       ->where('id', $user['id'])
       ->update([
           'email' => $email,
           'password_hash' => $hashedPassword,
           'is_admin' => 1,
           'updated_at' => date('Y-m-d H:i:s')
       ]);
    echo "Admin user updated successfully!<br>";
} else {
    // Create new admin user
    $db->table('users')->insert([
        'username' => $username,
        'email' => $email,
        'password_hash' => $hashedPassword,
        'is_admin' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    echo "Admin user created successfully!<br>";
}

echo "Username: " . $username . "<br>";
echo "Password: " . $password . "<br>";
echo "<strong>IMPORTANT: DELETE THIS FILE AFTER USE!</strong>";
