<?php 
namespace LoginQ;

use \LoginQ\DataSource;

class Member {
    private $con; // db connection name

    private $ds; // DataSource derived

    function __construct() {
        require_once "DaatSource.php";
        $this->db = new DataSoruce();
    }

    /* 
    * get user by user id
    */
    function getUserId($userid) {
        $qry = 'SELECT id,user_name,display_name,email FROM registered_users WHERE id = ?';
        $paramType = 'i';
        $arrayParam = array($userid);

        $result =  $this->db->select($qry,$paramType,$arrayParam);

        return $result;
    }

    /* 
    * process login
    */
    public function processLogin($userid,$password) {
        $hash = md5($password);
        $qry = 'SELECT id FROM registered_users WHERE user_name = ? AND password = ?';
        $paramType = 'ss'; 
        $arrayParam = array($userid,$password);

        $result =  $this->db->select($qry,$paramType,$arrayParam);
        if(!empty($result)) {
            $_SESSION['user_id'] = $result[0]['id'];
            return true;
        }
        return false;
    }
}
?>