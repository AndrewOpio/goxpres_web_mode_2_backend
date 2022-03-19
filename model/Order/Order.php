<?php

namespace model\Order;

use model\App;

class Order extends App
{
    public function __add_order($id, $user, $sname, $snumber, $dropoff, $rname, $rnumber, $pickup, $service, $schedule, $category, $type)
    {
        if ($user == "agent"):
            $status = "confirmed";

        else:
            $status = "pending";
        endif;
        
        $query = "INSERT INTO tbl_orders (user_id, user_type, service_type, delivery_type, sender_name, sender_contact, 
        dropoff, product_category, receiver_name, receiver_contact, pickup, payment_type, status) 
        VALUES($id, '$user', '$service', '$schedule', '$sname', '$snumber', $dropoff, '$category', '$rname', '$rnumber', '$pickup', '$type', '$status')";
        $result = mysqli_work_insert($query);

        if ($result):
            $this->Success = "Success";
            return $result;
        endif;

        $this->Error = "Failed";
        return false;
    }


    //get a specific order
    public function __get_order($id)
    {
        $query = "SELECT * FROM tbl_orders WHERE id =$id";
        $result = mysqli_work($query);
        
        if ($result->num_rows > 0):
            $data=[];
            $i = 0;
            while($row=$result->fetch_assoc()):
                $data[$i] = $row;
                $i++;

            endwhile;

            $this->Success = "Success";
            return $data;

        endif;
    }


    //updating order status
    public function update_order($id, $status)
    {
        $query = "UPDATE tbl_orders SET status = '$status' WHERE id = $id";
        $result = mysqli_work_update($query);

        if ($result):
            $this->Success = "Success";
            return true;
        endif;

        $this->Error = "Failed";
        return false;
    }
    
    
    //geting all orders
    public function __get_orders($id, $user)
    {
        if ($user == "agent"):
            $query = "SELECT * FROM tbl_orders WHERE dropoff = $id OR pickup = $id";
            $result = mysqli_work($query);
    
        else:
            $query = "SELECT * FROM tbl_orders WHERE user_id = $id";
            $result = mysqli_work($query);
    
        endif;
                
        if ($result->num_rows > 0):
            $data=[];
            $i = 0;
            while($row=$result->fetch_assoc()):
                $data[$i] = $row;
                $i++;

            endwhile;

            $this->Success = "Success";
            return $data;

        endif;
    }
}
