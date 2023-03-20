<?php
 include '../libs/session.php';
 Session::checkLogin();

 include_once '../libs/database.php';
 include_once '../helpers/format.php';

?>


<?php
/**
 * Admin login class 
*/
 class AdminLogin{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function adminLogin($adminUser, $adminPass){
      $adminUser = $this->fm->validation($adminUser);
      $adminPass = $this->fm->validation(md5($adminPass));

      $adminUser  = mysqli_real_escape_string($this->db->link, $adminUser);
      $adminPass  = mysqli_real_escape_string($this->db->link, $adminPass);
      
      if(empty($adminUser) || empty($adminPass)) { 
       $loginmsg = "please enter your username and password not empty";
       return $loginmsg; 
      } else{
         $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
         $result = $this->db->select($query);
         
         if($result != false){
            $value = $result->fetch_assoc();
            Session::set("adminLogin",true);
            Session::set("adminName", $value['adminName']);
            Session::set("adminPass", $value['adminPass']);
            Session::set("adminUser", $value['adminUser']);
            Session::set("adminId", $value['adminId']);
            Session::set("adminEmail", $value['adminEmail']);
            header("Location:index.php");
            
         }else{
            $loginmsg = "your username and password not match";
            return $loginmsg; 
         }

      }

 }


 }
?>