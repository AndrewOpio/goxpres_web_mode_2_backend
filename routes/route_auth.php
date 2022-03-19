<?php
    switch($request):
        case "login"://login route
                include_once "api/login.php";//Login Endpoint
                exit;
            break;

        case "signup"://signup route
                include_once "api/signup.php";//Signup Endpoint
                exit;
            break; 
        
    endswitch;