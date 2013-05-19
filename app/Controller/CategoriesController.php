<?php
class CategoriesController extends AppController{
	var $name = "Categories"; 
    var $helpers = array("Html"); 
    var $component = array("Session");
	function index(){
	}
	
	function add(){
		$error = "";
		$pageTitle = 'Add';
		if($this->Session->read('User.username') && $this->Session->read('level')==0){
			if(!empty($this->data['Category']['name']) && !empty($this->data['Category']['describle'])){
				$name = $this->data['Category']['name'];
				$describle = $this->data['Category']['describle'];
				$this->Category->set(array('name'=>$name,'describle'=>$describle));
				if($this->Category->save()){
					$this->redirect("index");
				}
			}
			else if(empty($this->data['Category'])){
				
			}
			else{
				$error = "Name & describle could not empty"; 
			}
        }    
        else 
            $this->redirect("index");
		$this->set("error",$error);
	}
}
?>