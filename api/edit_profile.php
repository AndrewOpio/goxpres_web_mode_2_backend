<?php 

   use model\User\User;

   require_api_headers();
   $data=json_decode(file_get_contents("php://input"));
   require_api_data($data, ['id', 'fname', 'lname', 'email', 'contact', 'location', 'password1', 'password2']);
   
   $NewRequest=new User;
   
   $result = $NewRequest->__edit_profile(
       clean($data->id),
       clean($data->fname),
       clean($data->lname),
       clean($data->email), 
       clean($data->contact),
       clean($data->location),
       clean($data->password1),
       clean($data->password2)
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
   