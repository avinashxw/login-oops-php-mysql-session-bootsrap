<?php 
namespace Loginq;

use \Loginq\DataSource;

class Member {
    private $dbcon; // db connection name

    private $ds; 

    function __construct() {
        require_once "DataSource.php";
        $this->db = new DataSource();
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
        $qry = 'SELECT id FROM registered_users WHERE email = ? AND pass = ?';
        $paramType = 'ss'; 
        $arrayParam = array($userid,$hash);

        $result =  $this->db->select($qry,$paramType,$arrayParam);
        
        if(!empty($result)) {
            $_SESSION['user_id'] = $result[0]['id'];
            return true;
        }
        return false;
    }
}
?>