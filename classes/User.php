
<?php
 $filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../libs/database.php');
include_once($filepath.'/../helpers/format.php');

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
}
?>