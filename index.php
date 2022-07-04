<?php

    require 'config/connection.php';
    require 'inc.php';

    // Get the last segment
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $lastUriSegment = array_pop($uriSegments);
    echo $lastUriSegment;

    if(isset($_GET['url']) && $_GET['url']!="")
    { 
        $url=urldecode($_GET['url']);
        if (filter_var($url, FILTER_VALIDATE_URL)) 
        {

        $slug=GetShortUrl($url);
        $conn->close();

        echo $base_url.'?s='.$slug;

        } 
        else 
        {
        die("$url is not a valid URL");
        }
        
    }
        else
        {	?>
        <center>
        <h1>Put Your Url Here</h1>
        <form>
        <p><input style="width:500px" type="url" name="url" required /></p>
        <p><input type="submit" /></p>
        </form>
        </center>
        <?php
    }
    
    if(isset($_GET['s']) && $_GET['s']!="")
    { 
    $slug=urldecode($_GET['s']);
    $url= GetRedirectUrl($slug);
    $conn->close();
    header("location:".$url);
    exit;
    }