<?php
 include_once '../libs/database.php';
 include_once '../helpers/format.php';
?>


<?php

class Brand{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandName){
        $brandName = $this->fm->validation($brandName);
        $brandName  = mysqli_real_escape_string($this->db->link, $brandName);
      
        if(empty($brandName)) { 
            $msg = "<span class='error'>Brand field must not be empty</span>";
            return $msg; 
           }else{
             $query = "INSERT INTO  tbl_brand (brandName) values('$brandName')";
             $brandInsert = $this->db->insert($query);
             if($brandInsert){
            $msg = "<span class='success'>Brand Inserted Successfully</span>";
            return $msg;
             }else{
                $msg = "<span class='error'>Brand Not Inserted</span>";
             return $msg;
             }
           }
    }


    public function getAllBrand(){
        $query = "SELECT * FROM tbl_Brand ORDER BY brandId ASC LIMIT 10";
        $result = $this->db->select($query);
        return $result;
    }



    // public function getCatById($id){
    //     $query = "SELECT * FROM tbl_Brand WHERE catId = '$id'";
    //     $result = $this->db->select($query);
    //     return $result;  
    // }

    // public function catUpdate($brandName ,$id){
    //     $brandName = $this->fm->validation($brandName);
    //     $brandName  = mysqli_real_escape_string($this->db->link, $brandName);
    //     if(empty($brandName)) { 
    //         $msg = "<span class='error'>Brand field must not be empty</span>";
    //         return $msg; 
    //        }else{
    //           $query = "UPDATE tbl_Brand set brandName = '$brandName'  WHERE catId = '$id'";
    //           $upDaterow = $this->db->update($query);
    //         //   return $result;  
    //           if($upDaterow){
    //             $msg = "<span class='success'>Brand Updated successfully</span>";
    //             return $msg; 
    //           }else{
    //             $msg = "<span class='error'>Brand not updated</span>";
    //             return $msg; 
    //           }
    //        }

    // }


//     public function catDelete($id){
//      $id  = mysqli_real_escape_string($this->db->link, $id);
//      $query = "DELETE FROM tbl_Brand WHERE catId = '$id'";
//      $delData = $this->db->delete($query);
 
//     if($delData){
//         $msg = "<span class='success'>Brand successfully deleted</span>";
//         return $msg; 
//     } else{
//         $msg = "<span class='error'>Brand not deleted</span>";
//         return $msg; 
//     }  
// }

}

?>