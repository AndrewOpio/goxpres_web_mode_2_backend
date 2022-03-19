<?php
    switch($request):
        case "db.run"://database route
                include_once "db_structure/database.php";//Database Endpoint
                exit;
            break;    
    endswitch;