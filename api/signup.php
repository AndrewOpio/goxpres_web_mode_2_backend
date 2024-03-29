<?php 

   use model\User\User;

   require_api_headers();
   $data=json_decode(file_get_contents("php://input"));
   require_api_data($data, ['fname', 'lname', 'email', 'contact', 'location', 'lat', 'lng', 'password']);
   
   $NewRequest=new User;
   
   $result = $NewRequest->__signup(
       clean($data->fname),
       clean($data->lname),
       clean($data->email), 
       clean($data->contact),
       clean($data->location),
       clean($data->lat),
       clean($data->lng),
       clean($data->password));

   if($result) 
   {
       $info=array(
           'status' => "OK",
           'message'=>$NewRequest->Success,
           'details' =>[$result]
       );
   }
   else
   {
       $info=array(
           'status' => 'Fail',
           'message'=>$NewRequest->Error,
           'details' =>[$result]
       );
   }
   
   print_r(json_encode($info));
   