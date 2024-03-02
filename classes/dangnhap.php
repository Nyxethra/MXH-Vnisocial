<?php

class login
{
    private $error ="";

    function evaluate()
    {

    }
        public function create_user($data)
        {

            $matkhau =addslashes($data['matkhau']);
            $email =addslashes($data['email']);

            $query = "select * from nguoidung where email='$email' limit 1";

            $DB = new Database();
            $result =$DB->read($query);

            if($result)
            {
                $row=$result[0];

                if($matkhau ==$row['matkhau'])
                {
                    //Create session data
                    $_SESSION['vnisoial_userid']=$row['userid'];
                }else
                {
                    $this->error .= "wrong password<br>";
                }
            }else
            {
                $this->error .= " khong tim thay email";
            }
                {
                return $this->error;
            }
        }
    }

    ?>
