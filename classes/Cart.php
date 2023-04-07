<?php
 $filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../libs/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../libs/session.php');
Session::init();

?>



<?php
class Cart{
   private $db;
   private $fm;
   public function __construct()
   {
       $this->db = new Database();
       $this->fm = new Format();
   }


   public function addToCart($quantity,$id){
    // echo "<script>alert('$id');</script>";
    $quantity   = $this->fm->validation($quantity);
    $quantity   = mysqli_real_escape_string($this->db->link, $quantity);
    $productId  = mysqli_real_escape_string($this->db->link, $id);
    $sId        =  session_id();

    $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
    $result = $this->db->select($query)->fetch_assoc();
    
    $productName   = $result['productName'];
    $price         = $result['price'];
    $image         = $result['image'];

    $checkQuery = "SELECT * FROM tbl_cart WHERE  productId ='$productId' AND sId = '$sId'";
    $getPro = $this->db->select($checkQuery);
    if($getPro){
     $msg = "Product Already Exists !";
    return $msg;
    }else{
    
        $query = "INSERT INTO tbl_cart(`sId`, `productId`,`productName`,`price`,`quantity`,`image`)VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
        $insertRows = $this->db->insert($query);
        if($insertRows){
            header("location:cart.php");
        }else{
            header("location:404.php");
    
        }
    }

   }


    public function getCartProduct(){
        $sId        =  session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }


   public function updateCartQuantity($quantity,$id){
     $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
     $id  = mysqli_real_escape_string($this->db->link, $id);
    
     $query = "UPDATE tbl_cart set quantity = '$quantity'  WHERE catId = '$id'";
        $upDaterow = $this->db->update($query);
        if($upDaterow){
            $msg = "<span class='success'>Quantity Updated successfully</span>";
            return $msg; 
        }else{
            $msg = "<span class='error'>Quantity not updated</span>";
            return $msg; 
        }
        

    }


    public function delProductCatBy($id){
        
        $id  = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM tbl_cart WHERE catId = '$id'";
        $delData = $this->db->delete($query);
    
        if($delData){
            $msg = "<span class='success'>Brand successfully deleted</span>";
            return $msg; 
        } else{
            $msg = "<span class='error'>Brand not deleted</span>";
            return $msg; 
        }  


    }

}
?>