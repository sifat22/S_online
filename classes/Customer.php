<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>
<?php 

    class Customer {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function addCustomer($data){
            $name=$this->fm->validation($data['name']);
            $city=$this->fm->validation($data['city']);
            $zip_code=$this->fm->validation($data['zip_code']);
            $email=$this->fm->validation($data['email']);
            $address=$this->fm->validation($data['address']);
            $country=$this->fm->validation($data['country']);
            $phone=$this->fm->validation($data['phone']);
            $password=$this->fm->validation($data['password']);

            $name=mysqli_real_escape_string($this->db->link,$data['name']);
            $city=mysqli_real_escape_string($this->db->link,$data['city']);
            $zip_code=mysqli_real_escape_string($this->db->link,$data['zip_code']);
            $email=mysqli_real_escape_string($this->db->link,$data['email']);
            $address=mysqli_real_escape_string($this->db->link,$data['address']);
            $country=mysqli_real_escape_string($this->db->link,$data['country']);
            $phone=mysqli_real_escape_string($this->db->link,$data['phone']);
            $password=mysqli_real_escape_string($this->db->link,md5($data['password']));

            //if empty
            if($name=="" || $city=="" || $zip_code=="" || $email==""
            || $address=="" || $country==""|| $phone=="" || $password==""){
                $msg="<span style='color:green;font-size:18px;'>User Filed Must not be Empty !</span>";
                return $msg;
            }else{
                $chkquery="SELECT * FROM tbl_customer WHERE email='$email' AND phone='$phone' LIMIT 1";
                $chkpro=$this->db->select($chkquery);
                if($chkpro){
                    $msg="<span style='color:green;font-size:18px;'>Phone or email already exist already added !</span>";
                    return $msg;
                    }else{
                        $query="INSERT INTO tbl_customer(name,city,zip_code,
                        email,address,country,phone,password)
                         VALUES('$name','$city','$zip_code',
                         '$email','$address','$country','$phone','$password')";
                         $insert_product=$this->db->insert($query);
                         if($insert_product){
                             $msg="<span style='color:green;font-size:18px;'>Registration Sucessfull !</span>";
                             return $msg;
                         }else{
                             $msg="<span style='color:red;font-size:18px;'>something is wrong....  </span>";
                             return $msg;
                         }
                    }
            }
           
        }
        
     //login
     public function customerLogin($data){
        $email=mysqli_real_escape_string($this->db->link,$data['email']);
        $password=mysqli_real_escape_string($this->db->link,md5($data['password']));
        if(empty($email) || empty($password)){
            $msg="Field Must Not Be empty";
            return $msg;
        }
        $query="SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
        $login=$this->db->select($query);
        if($login !=false){
            $value=$login->fetch_assoc();
            Session::set("customerLogin",true);
            Session::set("cmrid",$value['id']);
            Session::set("cmrName",$value['name']);
            Session::set("cmrEmail",$value['email']);
            header("Location:orderdetails.php");
            } else{
                $msg="Email or password not match !!!";
                return $msg;
        }
    }
    //get customer data
    public function getCustomerdata($id){
        $query="SELECT * FROM tbl_customer WHERE id='$id'";
        $login=$this->db->select($query);
        return $login;
    }
    
    }

