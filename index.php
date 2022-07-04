<?php
if(isset($_GET['url']) && $_GET['url']!="")
{ 
    require 'config/connection.php';
    $url=urldecode($_GET['url']);
    if (filter_var($url, FILTER_VALIDATE_URL)) 
    {
    $slug=GetShortUrl($url);
    $conn->close();

    echo $base_url.$slug;


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