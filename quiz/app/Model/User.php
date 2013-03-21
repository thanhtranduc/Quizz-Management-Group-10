<?php 
class User extends AppModel{ 
    var $name = "User"; 
  var $data;
     
    function checkLogin($username,$password){ 
        $sql = "Select * from users Where username='$username' AND password ='$password'"; 
        $data = $this->query($sql); 
        if($this->getNumRows()==0){ 
            return false; 
        }else
		{
            return true; 
        } 
    } 
	
	function getData(){
		return $data;
	}
} 
?>
