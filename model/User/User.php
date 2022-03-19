<?php

namespace model\User;

use model\App;
use model\Auth\Environment;
use model\Auth\JWT;

class User extends App
{

    public function __login($email, $password)
    {
        $query = "SELECT * FROM `tbl_users` WHERE `email`='$email'";
        $query .= " AND `password`='$password'";
        $result = mysqli_work($query);
        if ($result->num_rows > 0) {

            (new Environment('.env'))->load();//loads from index folder

            $row = $result->fetch_assoc();
            extract($row);
            $payload = array(
                "data" => array(
                    "iat" => time(),
                    "exp" => time() + (60),
                    "user_id" => $id,
                    "username" => $email,
                )
            );

            $token = JWT::encode($payload, getenv('JWT_SECRET'));
            $this->Success = "Login successful";
            return "user";

        } else {
            $query = "SELECT * FROM `tbl_agents` WHERE `email`='$email'";
            $query .= " AND `password`='$password'";
            $result = mysqli_work($query);
            if ($result->num_rows > 0) {

                (new Environment('.env'))->load();//loads from index folder

                $row = $result->fetch_assoc();
                extract($row);
                $payload = array(
                    "data" => array(
                        "iat" => time(),
                        "exp" => time() + (60),
                        "user_id" => $id,
                        "username" => $email,
                    )
                );

                $token = JWT::encode($payload, getenv('JWT_SECRET'));
                $this->Success = "Login successful";
                return "agent";
            }

            $this->Error = "Enter correct username and password";
            return false;
        }
    }



    public function __signup($fname, $lname, $email, $contact, $location, $lat, $lng, $password)
    {
        if ($location == "nvm"):
            $query = "INSERT INTO tbl_users (first_name, last_name, email, contact, status, password) 
            VALUES('$fname', '$lname', '$email', '$contact', 'active', '$password')";
            $result = mysqli_work_insert($query);

        else:
            $query = "INSERT INTO tbl_agents (first_name, last_name, email, contact, location, lat, lng, status, password)
             VALUES('$fname', '$lname', '$email', '$contact', '$location', '$lat', '$lng', 'active', '$password')";
            $result = mysqli_work_insert($query);

        endif;    

        if ($result):
            $this->Success = "Success";
            return $result;
        endif;

        $this->Error = "Failed";
        return false;
    }



    public function __get_profile($id, $type)
    {
        if ($type == 'agent'):
            $query = "SELECT * FROM tbl_agents WHERE id =$id";
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
        else:
            $query = "SELECT * FROM tbl_users WHERE id =$id";
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

        endif;
    }



    public function __edit_profile($id, $fname, $lname, $email, $contact, $location, $password1, $password2)
    {
        if ($location == "nvm"):
            if ($password1 != "nvm"):
                $query = "SELECT * FROM tbl_users WHERE password='$password1'";
                $result = mysqli_work($query);
                if ($result->num_rows > 0):
                    $query = "UPDATE tbl_users SET first_name = '$fname', last_name = '$lname',
                    email = '$email', contact = '$contact', password = '$password2' WHERE id = $id";
                    $result = mysqli_work_update($query);

                    if ($result):
                        $this->Success = "Success";
                        return 1;

                    endif;
                else:
                    $this->Error = "Failed";
                    return 0;            
                endif;
            else:
                $query = "UPDATE tbl_users SET first_name = '$fname', last_name = '$lname',
                email = '$email', contact = '$contact' WHERE id = $id";
                $result = mysqli_work_update($query);

                if ($result):
                    $this->Success = "Success";
                    return 1;

                endif;
            endif;

        else:
            if ($password1 != "nvm"):
                $query = "SELECT * FROM tbl_agents WHERE password='$password1'";
                $result = mysqli_work($query);
                if ($result->num_rows > 0):
                    $query = "UPDATE tbl_agents SET first_name = '$fname', last_name = '$lname', location = '$location',
                    email = '$email', contact = '$contact', password = '$password2' WHERE id = $id";
                    $result = mysqli_work_update($query);

                    if ($result):
                        $this->Success = "Success";
                        return 1;

                    endif;
                else:
                    $this->Error = "Failed";
                    return 0;            
                endif;
            else:
                $query = "UPDATE tbl_agents SET first_name = '$fname', last_name = '$lname', location = '$location',
                email = '$email', contact = '$contact' WHERE id = $id";
                $result = mysqli_work_update($query);

                if ($result):
                    $this->Success = "Success";
                    return 1;

                endif;
            endif;
        endif;    
    }
}

?>