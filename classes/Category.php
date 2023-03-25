<?php
 include_once '../libs/database.php';
 include_once '../helpers/format.php';
?>


<?php

class Category{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName){
        $catName = $this->fm->validation($catName);
        $catName  = mysqli_real_escape_string($this->db->link, $catName);
      
        if(empty($catName)) { 
            $msg = "<span class='error'>Category field must not be empty</span>";
            return $msg; 
           }else{
             $query = "INSERT INTO tbl_category(catName) values('$catName')";
             $catInsert = $this->db->insert($query);
             if($catInsert){
            $msg = "<span class='success'>Category Inserted Successfully</span>";
            return $msg;
             }else{
                $msg = "<span class='error'>Category Not Inserted</span>";
             return $msg;
             }
           }
    }


    public function getAllCat(){
        $query = "SELECT * FROM tbl_category ORDER BY catId ASC LIMIT 10";
        $result = $this->db->select($query);
        return $result;
    }



    public function getCatById($id){
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;  
    }

    public function catUpdate($catName ,$id){
        $catName = $this->fm->validation($catName);
        $catName  = mysqli_real_escape_string($this->db->link, $catName);
        if(empty($catName)) { 
            $msg = "<span class='error'>Category field must not be empty</span>";
            return $msg; 
           }else{
              $query = "UPDATE tbl_category set catName = '$catName'  WHERE catId = '$id'";
              $upDaterow = $this->db->update($query);
            //   return $result;  
              if($upDaterow){
                $msg = "<span class='success'>Category Updated successfully</span>";
                return $msg; 
              }else{
                $msg = "<span class='error'>Category not updated</span>";
                return $msg; 
              }
           }

    }


    public function catDelete($id){
     $id  = mysqli_real_escape_string($this->db->link, $id);
     $query = "DELETE FROM tbl_category WHERE catId = '$id'";
     $delData = $this->db->delete($query);
 
    if($delData){
        $msg = "<span class='success'>Category successfully deleted</span>";
        return $msg; 
    } else{
        $msg = "<span class='error'>Category not deleted</span>";
        return $msg; 
    }  
}

}

?>