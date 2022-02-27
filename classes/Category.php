<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>
<?php 

    class Category{
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
///insert Category
        public function addCat($catName){
             $catName=$this->fm->validation($catName);
             $catName=mysqli_real_escape_string($this->db->link,$catName);
             //cant add same Category
                $chkquery="SELECT * FROM tbl_category WHERE catName='$catName'";
                $chkpro=$this->db->select($chkquery);
                if($chkpro){
                    $msg="<span style='color:green;font-size:18px;'>Category already added !</span>";
                    return $msg;
                    }else{
                    if(empty($catName)){
                        $msg="<span style='color:green;font-size:18px;'>Category Filed Must not be Empty !</span>";
                        return $msg;
                    }else{
                        $query="INSERT INTO tbl_category(catName) VALUES('$catName')";
                        $insert_cat=$this->db->insert($query);
                        if($insert_cat){
                            $msg="<span style='color:green;font-size:18px;'>Category Inserted Sucesfully !</span>";
                            return $msg;
                        }else{
                            $msg="<span style='color:red;font-size:18px;'>Category Not Inserted  !</span>";
                            return $msg;
                    }
                }
            }
        }
         ///showing Category

    public function getAllCat(){
        $query="SELECT * FROM tbl_category ORDER BY catId DESC";
        $getcat=$this->db->select($query);
        return $getcat;
    }

    ///edit category
    public function getEditCatById($id){
        $query="SELECT * FROM tbl_category WHERE catId='$id'";
        $getcatByid=$this->db->select($query);
        return $getcatByid;
    }

    //update cat
        
        public function updateCat($catName,$id){
            $catName=$this->fm->validation($catName);
            $catName=mysqli_real_escape_string($this->db->link,$catName);
            $id=mysqli_real_escape_string($this->db->link,$id);
            if(empty($catName)){
                $msg="<span style='color:green;font-size:18px;'>Category Filed Must not be Empty !</span>";
                return $msg;
            }else{
                $query="UPDATE tbl_category
                        SET
                        catName='$catName'
                        WHERE catId='$id'";
                $update=$this->db->update($query);
                if($update){
                    $msg="<span style='color:green;font-size:18px;'>Category Updated Sucesfully !</span>";
                    return $msg;
                   
                }else{
                    $msg="<span style='color:red;font-size:18px;'>Category Not Updated  !</span>";
                    return $msg;
            }
        } 

        }

        //delete category

        public function delCatById($id){
            $query="DELETE FROM tbl_category WHERE catId='$id'";
            $delcat=$this->db->delete($query);
            if($delcat){
                $msg="<span style='color:green;font-size:18px;'>Category Deleted Sucesfully !</span>";
                return $msg;
        }
    }

}
   
?>