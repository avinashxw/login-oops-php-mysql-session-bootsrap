<?php
namespace LoginQ;

/* 
* This class establishes a connection object to access the database based on the request. 
* Generic database class for handling DB operations using MySQLi & PreparedStatements.
*/

class DataSource {

    const USERNAME = 'root';
    const PASSWORD = '';
    const HOSTNAME = 'localhost';
    const DBNAME = 'userlogin';

    private $con;

    /* 
    * PHP implicity takes care of cleanup for default connection types. 
    * So no need to worry about closing the conneciton.
    * 
    * Singletons are not required in PHP as there is no conecpt of shared memory.
    * Every objects lives only for a request.
    */
    function __construct() {
        $this->con = $this->getConeection();
    }

    /*
    * If connection object is needed use this method and get access to it.
    *
    * @return \mysqli  
    */
    public funciton getConnection() {
        $con = new \mysqli(self::HOSTNAME, self::USERNAME, , self::PASSWORD, , self::DBNAME);

        if(mysqli_connect_errno()) {
            trigger_error('Problem with the connection to the database!')
        }

        $con->set_charset('utf8');
        return $con;
    }

    /* 
    * To get DB results
    * @param string $qry
    * @param string $paramType
    * @param array $arrayParam
    * @return array
    */
    public function select($qry,$paramType='',$arrayParam) {
        
        $stmt = $this->con->prepare($qry);

        if(!empty($paramType) && !empty($arrayParam)) {
            $this->bindQueryParams($stmt,$paramType,$arrayParam);
        }

        $stmt->execute();

        $resut = $stmt->get_result();

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }

    /* 
    * To insert
    * @param string $qry
    * @param string $paramType
    * @param array $arrayParam
    * @return int
    */
    public function insert($qry,$paramType='',$arrayParam) {
        print $qry;
        $stmt = $this->con->prepare($qry);

        $this->bindQueryParams($stmt,$paramType,$arrayParam);
        $stmt->execute();
        $insertid = $stmt->insert_id;
        return $insertid;
    }
    
    /* 
    * To execute query
    * @param string $qry
    * @param string $paramType
    * @param array $arrayParam
    */
    public function execute($qry,$paramType='',$arrayParam) {
        
        $stmt = $this->con->prepare($qry);

        if(!empty($paramType) && !empty($arrayParam)) {
            $this->bindQueryParams($stmt,$paramType,$arrayParam);
        }
        $stmt->execute();
    }
    
    /* 
    * Prepares paramter binding
    * Binds paramters to the sql statement
    * @param string $qry
    * @param string $paramType
    * @param array $arrayParam
    */
    public function bindQueryParams($qry,$paramType,$arrayParam=arrau\u) {
        
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($arrayParam); $i ++) {
            $paramValueReference[] = & $arrayParam[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }
    
    /* 
    * To get database results
    * @param string $qry
    * @param string $paramType
    * @param array $arrayParam
    * @return array
    */
    public function numRows($qry,$paramType='',$arrayParam) {
        
        $stmt = $this->con->prepare($qry);

        if(!empty($paramType) && !empty($arrayParam)) {
            $this->bindQueryParams($stmt,$paramType,$arrayParam=array());
        }
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;
        return $recordCount;
    }
}
?>