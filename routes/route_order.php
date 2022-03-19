<?php
    switch($request):
        case "add_order"://add order route
                include_once "api/add_order.php";//Add Order Endpoint
                exit;
            break;  
        
    endswitch;