<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>
<?php 

    class Product{
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function addProduct($data,$file){
            $productName=$this->fm->validation($data['productName']);
            $catId=$this->fm->validation($data['catId']);
            $brandId=$this->fm->validation($data['brandId']);
            $body=$this->fm->validation($data['body']);
            $price=$this->fm->validation($data['price']);
            $type=$this->fm->validation($data['type']);
            $productName=mysqli_real_escape_string($this->db->link,$data['productName']);
            $catId=mysqli_real_escape_string($this->db->link,$data['catId']);
            $brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
            $body=mysqli_real_escape_string($this->db->link,$data['body']);
            $price=mysqli_real_escape_string($this->db->link,$data['price']);
            $type=mysqli_real_escape_string($this->db->link,$data['type']);

            //image validation
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            $chkquery="SELECT * FROM tbl_product WHERE productName='$productName'";
            $chkpro=$this->db->select($chkquery);
            if($chkpro){
                $msg="<span style='color:green;font-size:18px;'>Category already added !</span>";
                return $msg;
                }else{
            if($productName=="" || $catId=="" || $brandId=="" || $body==""
            || $price=="" || $type==""){
                $msg="<span style='color:green;font-size:18px;'>Category Filed Must not be Empty !</span>";
                return $msg;
            }elseif ($file_size >1048567) {
                echo "<span class='error'>Image Size should be less then 1MB!
                </span>";
               } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can upload only:-"
                .implode(', ', $permited)."</span>";
               }  else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query="INSERT INTO tbl_product(productName,catId,brandId,
                body,price,	image,type)
                 VALUES('$productName','$catId','$brandId',
                 '$body','$price','$uploaded_image','$type')";
                 $insert_product=$this->db->insert($query);
                 if($insert_product){
                     $msg="<span style='color:green;font-size:18px;'>Products Inserted Sucesfully !</span>";
                     return $msg;
                 }else{
                     $msg="<span style='color:red;font-size:18px;'>Products Not Inserted  !</span>";
                     return $msg;
                 }
    
            }

        }
    }
    //showing product
    public function getAllProduct(){
        $query="SELECT tbl_product.*,tbl_category.catName,
        tbl_brand.brandName
        FROM tbl_product
        INNER JOIN tbl_category ON
        tbl_product.catId=tbl_category.catId
        INNER JOIN tbl_brand ON
        tbl_product.brandId=tbl_brand.brandId
         ORDER BY tbl_product.productId DESC";
        $getproduct=$this->db->select($query);
        return $getproduct;
    }
    ///edit product
    public function editProductByid($productid){
        $query="SELECT * FROM tbl_product WHERE productId='$productid'";
        $show_product=$this->db->select($query);
        return $show_product;
    }
    ///update product
    public function productUpdate($data,$file,$productid){
        $productName=mysqli_real_escape_string($this->db->link,$data['productName']);
        $catId=mysqli_real_escape_string($this->db->link,$data['catId']);
        $brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
        $body=mysqli_real_escape_string($this->db->link,$data['body']);
        $price=mysqli_real_escape_string($this->db->link,$data['price']);
        $type =mysqli_real_escape_string($this->db->link,$data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;
        if($productName=="" ||$catId=="" ||$brandId==""||$body==""
        ||$price==""|| $type="" ){
            $msg="<span style='color:red;font-size:18px;'>Filed must not be empty  !</span>";
            return $msg;
        }else{
            if(!empty($file_name)){

            
        if ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!
            </span>";
           } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
            .implode(', ', $permited)."</span>";
           }  else{
            move_uploaded_file($file_temp, $uploaded_image);
            
             $query="UPDATE tbl_product
                    SET
                    productName='$productName',
                    catId='$catId',
                    brandId='$brandId',
                    body='$body',
                    price='$price',
                    image='$uploaded_image',
                    type='$type'
                    WHERE productId='$productid'";
             $update_product=$this->db->update($query);
             if($update_product){
                 $msg="<span style='color:green;font-size:18px;'>Products Updated Sucesfully !</span>";
                 return $msg;
             }else{
                 $msg="<span style='color:red;font-size:18px;'>Products Not Updated  !</span>";
                 return $msg;
             }

        }
    }else{
        $query="UPDATE tbl_product
        SET
        productName='$productName',
        catId='$catId',
        brandId='$brandId',
        body='$body',
        price='$price',
        type='$type'
        WHERE productId='$productid'";
 $update_product=$this->db->update($query);
 if($update_product){
     $msg="<span style='color:green;font-size:18px;'>Products Updated Sucesfully !</span>";
     return $msg;
 }else{
     $msg="<span style='color:red;font-size:18px;'>Products Not Updated  !</span>";
     return $msg;
 }

    } 

    }

 }



 ///get featured product for front view
    public function getFeaturedProduct(){
        $query="SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
        $getfeature=$this->db->select($query);
        return $getfeature;
    
    }
     ///get New product for front view
     public function getNewProduct(){
        $query="SELECT * FROM tbl_product WHERE type='1' ORDER BY productId DESC LIMIT 4";
        $getfeature=$this->db->select($query);
        return $getfeature;
    
    }
    //product details single by id
    public function getSingleProductById($id){
        $query="SELECT p.*,c.catName,b.brandName
        FROM tbl_product as p,tbl_category as c,tbl_brand as b
        WHERE p.catId=c.catId AND p.brandId=b.brandId AND
         p.productID='$id'
        ";
        $show_product=$this->db->select($query);
        return $show_product;

    }
    ///latest From Iphobne
    public function latestFromIphone(){
        $query="SELECT * FROM tbl_product WHERE brandId='1' ORDER BY productId DESC LIMIT 1";
        $result=$this->db->select($query);
        return $result;
    }
        ///latest From Samsung
        public function latestFromSamsung(){
            $query="SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        }
        ///latest From Acer
        public function latestFromAcer(){
            $query="SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        }
        ///latest From Canon
        public function latestFromCanon(){
            $query="SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        }

        ///get all category product
        public function getAllProductByCAt(){
            $query="SELECT * FROM tbl_product ORDER BY productId DESC";
            $result=$this->db->select($query);
            return $result;
        }
}

?>

