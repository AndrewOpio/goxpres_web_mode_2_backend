<?php
    switch($request):
        case "edit_profile"://edit profile route
                include_once "api/edit_profile.php";//Edit Profile Endpoint
                exit;
            break;  
        
        case "get_profile"://get profile route
                include_once "api/get_profile.php";//Get Profile Endpoint
                exit;
            break;  

    endswitch;