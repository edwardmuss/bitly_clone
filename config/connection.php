<?php 
/**
 * @param servername (Host)
 * @param username (db user)
 * @param dbname (database name)
 * @param password (database Password)
 * @param base_url (root url)
 */
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bitly_clone';
$base_url='http://localhost/bitly_clone/'; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 