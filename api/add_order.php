<?php 

   use model\Order\Order;

   require_api_headers();
   $data=json_decode(file_get_contents("php://input"));
   require_api_data($data, ['id', 'user', 'sname', 'snumber', 'dropoff', 'rname', 'rnumber', 'pickup', 'service', 'schedule', 'category', 'type']);
   
   $NewRequest=new Order;
   
   $result = $NewRequest->__add_order(
       clean($data->id),
       clean($data->user),
       clean($data->sname),
       clean($data->snumber),
       clean($data->dropoff), 
       clean($data->rname),
       clean($data->rnumber),
       clean($data->pickup),
       clean($data->service),
       clean($data->schedule),
       clean($data->category),
       clean($data->type)
    );

   if($result): 
       $info=array(
           'status' => "OK",
           'message'=>$NewRequest->Success,
           'details' =>[$result]
       );

    else:
       $info=array(
           'status' => 'Fail',
           'message'=>$NewRequest->Error,
           'details' =>[$result]
       );
    endif;
   
   print_r(json_encode($info));
   