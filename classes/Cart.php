<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');


?>
<?php

class Cart{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db=new Database();
        $this->fm=new Format();
    }
    public function addCart($quantity,$id){
        $quantity=$this->fm->validation($quantity);
        $id=$this->fm->validation($id);
        $quantity=mysqli_real_escape_string($this->db->link,$quantity);
        $productid=mysqli_real_escape_string($this->db->link,$id);
        $sId=session_id();
///take value from one table
        $seelectquery="SELECT * FROM tbl_product WHERE productId='$productid'";
        $result=$this->db->select($seelectquery)->fetch_assoc();

        $productName=$result['productName'];
        $price=$result['price'];
        $image=$result['image'];
        ///cant add same product
        $chkquery="SELECT * FROM tbl_cart WHERE productId='$id' AND sId='$sId'
        ";
        $chkpro=$this->db->select($chkquery);
        if($chkpro){
            $msg="product already added !";
            return $msg;

        }else{
///insert value another table
        $insertquery="INSERT INTO tbl_cart(sId,productid,productName,
        price,quantity,	image)
         VALUES('$sId','$id','$productName',
         '$price','$quantity','$image')";
         $insert_row=$this->db->insert($insertquery);
         if($insert_row){
             header("location:cart.php");
         }else{
            header("location:404.php");
         }
        }
    }
    /// show product at the cart
    public function showAllProduct(){
        $sId=session_id();
        $query="SELECT * FROM tbl_cart Where sId='$sId'";
        $show_cart=$this->db->select($query);
        return $show_cart;
    }
    ///update cart
    public function updateCartById($cartId,$quantity){
        $cartId=$this->fm->validation($cartId);
        $quantity=$this->fm->validation($quantity);
        $cartId=mysqli_real_escape_string($this->db->link,$cartId);
        $quantity=mysqli_real_escape_string($this->db->link,$quantity);
        
            $update_query="UPDATE tbl_cart
            SET
            quantity='$quantity'
            WHERE cartId='$cartId'
            ";
            $update_row=$this->db->update($update_query);
            if($update_row){
                echo "<script>window.location='cart.php'</script>";
            }else{
                $msg="<span style='color:red;font-size:18px;'>Quantity Not Updated !</span>";
                return $msg;
            }
        }
        ///delete cart

        public function deletCartById($delcartid){
            $delcartid=mysqli_real_escape_string($this->db->link,$delcartid);

            $delquery="DELETE FROM tbl_cart WHERE cartId='$delcartid'";
            $delcart=$this->db->delete($delquery);
            if($delcart){
               echo "<script>window.location='cart.php'</script>";
            }else{
                $msg="<span style='color:red;font-size:18px;'>Cart Not Deleted  !</span>";
                return $msg;
            }
        }

        /// checking that you have data in you cart or empty
        public function chkCartTable(){
            $sId=session_id();
            $query="SELECT * FROM tbl_cart Where sId='$sId'";
            $result=$this->db->select($query);
            return $result;
        }

        ///del cart after logout
        public function delCustomercart(){
            $sId=session_id();
            $query="DELETE FROM tbl_cart Where sId='$sId'";
            $result=$this->db->delete($query);
            return $result;
        }

        ///order product
       // take data from tbl_cart by session id and insert tbl_order
        public function OrderProduct($id){
            $sId=session_id();
            $query="SELECT * FROM tbl_cart Where sId='$sId'";
            $getpro=$this->db->select($query);
            if($getpro){
                while($result=$getpro->fetch_assoc()){
                    $productId=$result['productId'];
                    $productName=$result['productName'];
                    $quantity=$result['quantity'];
                    $price=$result['price'] * $result['quantity'];
                    $image=$result['image'];
                    $insertquery="INSERT INTO tbl_order(cmrId,productId,productName,
                    quantity,price,image)
                    VALUES('$id','$productId','$productName',
                    '$quantity','$price','$image')";
                    $insert_row=$this->db->insert($insertquery);
 
                }
            }
        }


        //get amount in offline order
        public function payaableAmount($id){
            $query="SELECT price FROM tbl_order Where cmrId='$id' AND date=now()";
            $result=$this->db->delete($query);
            return $result;
        }

      ///get Order from ordfer details page...  
      public function getOrdereProduct($id){
        $query="SELECT * FROM tbl_order Where cmrId='$id' ORDER BY date  ";
        $result=$this->db->delete($query);
        return $result;
      }
      ///get order message in admin
      public function getAllOrderProduct(){
        $query="SELECT * FROM tbl_order  ORDER BY date";
        $result=$this->db->delete($query);
        return $result;
      }
      ///shifted product
      public function productShifted($id,$price){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $price=mysqli_real_escape_string($this->db->link,$price);
        $query="UPDATE tbl_order
        SET
        status='1'
        WHERE cmrId='$id' AND price='$price'";
        $update=$this->db->update($query);
        if($update){
            $msg="<span style='color:green;font-size:18px;'> Updated Sucesfully !</span>";
            return $msg;
        
        }else{
            $msg="<span style='color:red;font-size:18px;'> Not Updated  !</span>";
            return $msg;
        }
    }
    //delete shifed product
    public function delshiftedProduct($id,$price){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $price=mysqli_real_escape_string($this->db->link,$price);
        $delquery="DELETE FROM tbl_order WHERE cmrId='$id' AND price='$price'";
        $delcart=$this->db->delete($delquery);
            if($delcart){
                $msg="<span style='color:red;font-size:18px;'>Data Deleted Succesfully !</span>";
            }else{
                $msg="<span style='color:red;font-size:18px;'>Data Not Deleted  !</span>";
                return $msg;
            }
    }

    ///confirming the product
    public function confirmedProduct($id,$price,$time){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $price=mysqli_real_escape_string($this->db->link,$price);
        $time=mysqli_real_escape_string($this->db->link,$time);
        $query="UPDATE tbl_order
        SET
        status='2'
        WHERE cmrId='$id' AND price='$price' AND date='$time'";
        $update=$this->db->update($query);
        if($update){
            $msg="<span style='color:green;font-size:18px;'> Updated Sucesfully !</span>";
            return $msg;
        
        }else{
            $msg="<span style='color:red;font-size:18px;'> Not Updated  !</span>";
            return $msg;
        }
    }
}
   
?>