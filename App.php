<?php
/**
 * THIS IS THE APPLICATION ROUTER
 * 
 * ALL ENDPOINTS SHOULD BE INCLUDED IN THE api FOLDER
 */
    include_once "include/autoloader.php";
    include_once "include/functions.php";
    $request=get_request_name($uri_depth=1);
    
    include_once "routes/route_database.php";
    include_once "routes/route_auth.php";
    include_once "routes/route_profile.php";
    include_once "routes/route_order.php";

    include_once "api/404.php";
?>