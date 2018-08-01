<!-- esle connect garne kam garira xa -->

<?php
class User {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = '';
    private $dbName     = "safalbhawisya";
    private $userTbl    = 'userregistration  ';
    
    function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    function checkUser($userData = array()){
        if(!empty($userData)){
            // Check whether user data already exists in database
            // $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE user_id = '".$userData['oauth_uid']."'";
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE email = '".$userData['email']."'";

            $prevResult = $this->db->query($prevQuery); 
            if($prevResult->num_rows > 0){
                //Update user data if already exists
                $query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
                $update = $this->db->query($query);
                $_SESSION['email'] = $userData['email'];
            }else{
                //Insert user data
                
                 $query = "INSERT INTO ".$this->userTbl." SET method = 'Google', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', pictures = '".$userData['picture']."'";
                $insert = $this->db->query($query);
                $_SESSION['email'] = $userData['email'];
                
            }
            
            //Get user data from the database
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }
        
        //Return user data
        return $userData;
    }
}
?>