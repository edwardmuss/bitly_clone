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

   function GetRedirectUrl($slug){
    global $conn;
    $query = "SELECT * FROM url_shorten WHERE short_code = '".addslashes($slug)."' "; 
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hits=$row['hits']+1;
    $sql = "update url_shorten set hits='".$hits."' where id='".$row['id']."' ";
    $conn->query($sql);
    return $row['url'];
    }
    else 
        { 
    die("Invalid Link!");
    }
   }