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
        $firstname =ucfirst($data['firstname']);
        $lastname =ucfirst($data['lastname']);
        $matkhau =$data['matkhau'];
        $matkhau2 =$data['matkhau2'];
        $email =$data['email'];
        $gioitinh =$data['gioitinh'];
        // $ngay =$data['ngay'];
        // $thang=$data['Thang'];
        // $nam=$data['nam'];

        //create these
        $ten_nguoidung =strtolower($firstname) . ".". strtolower($lastname) ;
        // $ngaysinh=$ngay . $thang . $nam;
        $query = "insert into nguoidung( ten_nguoidung , matkhau, email,gioitinh, ngaysinh)
        values ('$ten_nguoidung', '$matkhau', '$email','gioitinh', '')";
        // echo $query;
        $DB = new Database();
        $DB->save($query);
    }
}
?>