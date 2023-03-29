<?php
 $filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../libs/database.php');
include_once($filepath.'/../helpers/format.php');

?>

<?php
class Product{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function productInsert($data,$file){
        // print_r($data);
        $productName  = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId  = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId  = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body  = mysqli_real_escape_string($this->db->link, $data['body']);
        $price  = mysqli_real_escape_string($this->db->link, $data['price']);
        $type  = mysqli_real_escape_string($this->db->link, $data['type']);

         $file_name = $file['image']['name'];
         $file_temp = $file['image']['tmp_name'];

         $div = explode('.', $file_name);
         $file_ext = strtolower(end($div));
         $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
         $uploaded_image = "upload/".$unique_image;
         move_uploaded_file($file_temp, $uploaded_image);
        if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == ""){
            $msg = "<span class='error'>product field must not be empty</span>";
            return $msg; 
         }else{
         $query = "INSERT INTO tbl_product(`productName`, `catId`,`brandId`,`body`,`price`,`image`,`type`)VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
        $productInserts = $this->db->insert($query);
        if($productInserts){
        $msg = "<span class='success'>Product Inserted Successfully</span>";
        return $msg;
        }else{
            $msg = "<span class='error'>Product Not Inserted</span>";
        return $msg;
        }         
        }
        }




      public function getAllProduct(){

        $query = "SELECT p.* ,c.catName , b.brandName
        FROM tbl_product as p, tbl_category as c, tbl_brand as b 
        WHERE P.catId = c.catId AND P.brandId = b.brandId 
        ORDER BY p.productId DESC";
       

        // $query = "SELECT tbl_product.* ,tbl_category.catName, tbl_brand.brandName
        // FROM tbl_product
        // INNER JOIN tbl_category 
        // ON tbl_product.catId = tbl_category.catId
        // INNER JOIN tbl_brand 
        // ON tbl_product.brandId = tbl_brand.brandId
        //  ORDER BY tbl_product.productId DESC";
        $result = $this->db->select($query);
        return $result;
        }


     public function getFeatureProduct(){
        $query = "SELECT * FROM tbl_product WHERE type= '0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
     }


     public function getNewProduct(){
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
     }

    public function singleProduct($id){
        $query = "SELECT p.* ,c.catName , b.brandName
        FROM tbl_product as p, tbl_category as c, tbl_brand as b 
        WHERE P.catId = c.catId AND P.brandId = b.brandId AND P.productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }




}
?>