<?php

class Signup
{
    private $error = "";
    public function evaluate($data)
    {
        foreach($data as $key => $value){
            if(empty($value))
            {
                $this->error = $this->error . $key . " dang de trong! <br>";
            }
        }
        if($this->error =="")
        {
            //no error
            $this->create_user($data);
        }else
        {
            return $this->error;
        }
    }
    public function create_user($data)
    {
        $name=$data['name'];
        $matkhau =$data['matkhau'];
        $email =$data['email'];

        $query = "insert into nguoidung( ten_nguoidung , matkhau, email)
        values ('$name', '$matkhau', '$email')";

        $DB = new Database();
        $DB->save($query);
    }
}
?>