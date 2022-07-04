<?php
require 'config/connection.php';
function GetShortUrl($url){
    global $conn;
    $query = "SELECT * FROM url_shorten WHERE url = '".$url."' "; 
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
    return $row['short_code'];
   } else {
        $short_code = generateUniqueID();
        $sql = "INSERT INTO url_shorten (url, short_code, hits)
        VALUES ('".$url."', '".$short_code."', '0')";
        if ($conn->query($sql) === TRUE) {
        return $short_code;
   } else { 
        die("Unknown Error Occured");
   }
   }
   }

   function generateUniqueID(){
    global $conn; 
    $token = substr(md5(uniqid(rand(), true)),0,6); 
    $query = "SELECT * FROM url_shorten WHERE short_code = '".$token."' ";
    $result = $conn->query($query); 
    if ($result->num_rows > 0) {
    generateUniqueID();
    } else {
    return $token;
    }
   }