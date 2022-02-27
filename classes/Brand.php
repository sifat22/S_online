<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>
<?php 

    class Brand{
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
        ///insert Brand
        public function addBrand($brandName){
            $brandName=$this->fm->validation($brandName);
            $brandName=mysqli_real_escape_string($this->db->link,$brandName);
            //can not add same product
            $chkquery="SELECT * FROM tbl_brand WHERE brandName='$brandName'";
            $chkpro=$this->db->select($chkquery);
            if($chkpro){
                $msg="<span style='color:green;font-size:18px;'>Brand already added !</span>";
                return $msg;
                }else{
                    if(empty($brandName)){
                        $msg="<span style='color:red;font-size:18px;'>Brand Filed Must not be Empty !</span>";
                        return $msg;
                    }else{
                        $query="INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                        $insert_brand=$this->db->insert($query);
                        if($insert_brand){
                            $msg="<span style='color:green;font-size:18px;'>Brand Inserted Sucesfully !</span>";
                            return $msg;
                        }else{
                            $msg="<span style='color:red;font-size:18px;'>Brand Not Inserted  !</span>";
                            return $msg;
                    }
                }
            }
        }
        ///showing All brand
        public function getAllBrand(){
            $query="SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $getbrand=$this->db->select($query);
            return $getbrand;
        }
        //edit barnd
        public function getEditBrandById($id){
            $query="SELECT * FROM tbl_brand WHERE brandId='$id'";
            $getbrand=$this->db->select($query);
            return $getbrand;
        }
        //update brand
        public function updateBrand($brandName,$id){
            $brandName=$this->fm->validation($brandName);
            $brandName=mysqli_real_escape_string($this->db->link,$brandName);
            $id=mysqli_real_escape_string($this->db->link,$id);
            if(empty($brandName)){
                $msg="<span style='color:green;font-size:18px;'>Brand Filed Must not be Empty !</span>";
                return $msg;
            }else{
                $query="UPDATE tbl_brand
                        SET
                        brandName='$brandName'
                        WHERE brandId='$id'";
                $update=$this->db->update($query);
                if($update){
                    $msg="<span style='color:green;font-size:18px;'>Brand Updated Sucesfully !</span>";
                    return $msg;
                   
                }else{
                    $msg="<span style='color:red;font-size:18px;'>Brand Not Updated  !</span>";
                    return $msg;
            }
        }

    }
    //delete brand
    public function delbrandById($id){
        $query="DELETE FROM tbl_brand WHERE brandId='$id'";
            $delbrand=$this->db->delete($query);
            if($delbrand){
                $msg="<span style='color:green;font-size:18px;'>Brand Deleted Sucesfully !</span>";
                return $msg;
            }
         }
     }


?>