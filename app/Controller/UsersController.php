<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
class UsersController extends AppController{
    //var $layout = false; // Không s? d?ng Layout m?c d?nh c?a CakePHP , dùng file CSS riêng 
	
    var $name = "Users"; 
    var $helpers = array("Html"); 
    var $component = array("Session");      
    var $_sessionUsername  = "User.username"; // tên Session du?c qui d?nh tru?c 
	var $uses = array('User','Category','Point');
	var $paginate = array(
        'limit' => 20,
        'order' => array(
            'User.id' => 'asc'
        )
    );
	
	function getCategory(){
		$categories = $this->Category->find('all',array('fields'=>array('Category.id','Category.name')));
		$i = 0;
		foreach ($categories as $category): {
			$key[$i] = $category['Category']['id'];
			$value[$i] = $category['Category']['name'];
			$i++;
			}
		endforeach; 
		$categories = array_combine($key,$value);
		return $categories;
	}
    

     
    //--------- Login 
    function login(){ 
		$pageTitle = 'Login';
		$error="";// thong bao loi 
		
        if($this->Session->read($this->_sessionUsername)) 
            $this->redirect("/"); 
			
        if(isset($_POST['ok'])){ 
			$username = $_POST['username']; 
			$password = $_POST['password'];  
			if($this->User->checkLogin($username,$password)){ 
                $this->Session->write("User.username",$username); 
				$this->getInfo();
                $this->redirect("/"); 
            }else{ 
                $error = "Username or Password wrong !"; 
           } 
        } 
		$this->Session->delete('User'); 
        $this->set("error",$error); 
        $this->render("/users/login"); 
    } 
	
	function login_android(){
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username']; 
			$password = $_POST['password'];  
			if($this->User->checkLogin($username,$password)){ 
				$this->Session->write("User.username",$username); 
				$this->getInfo();
				$response = array('Success'=>$this->Session->read('User.level'));
			}else{ 
				if($username == '' || $password == '')
					$response = array('Success'=>-2);
				else
					$response = array('Success'=>-1);
			}
		}else{
			$response = array('Success'=>-2);
		}
		return new CakeResponse(array('body' => json_encode($response)));
	}
	
    //---------- Logout 
	function index(){
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
    function logout(){ 
        $this->Session->delete('User'); 
        $this->redirect("/"); 
    } 
	
	function register(){
		$pageTitle = 'Register';
		$error="";
		if(!$this->Session->read($this->_sessionUsername)){
			if(!empty($this->data['User']['username']) && !empty($this->data['User']['password']) &&!empty($this->data['User']['email'])){
				$username = $this->data['User']['username']; 
				$password = $this->data['User']['password']; 
				$email = $this->data['User']['email'];
				$level = $this->data['User']['level'];
				$this->User->set(array('username'=>$username,'email'=>$email,'password'=>$password,'level'=>$level));
				if($this->User->save()){
					$this->redirect("login");
				}
			}
			else if(empty($this->data['User'])){
				
			}
			else{
				$error = "Please fill on row have (*)"; 
			}
        }    
        else 
            $this->redirect("index");
		$this->set("error",$error);
	}
	
	function register_android(){
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
			if($_POST['username'] != '' && $_POST['password'] != '' && $_POST['email'] != ''){
				$username = $_POST['username']; 
				$password = $_POST['password']; 
				$email = $_POST['email'];
				$level = $_POST['level'];
				if($this->User->find('count',array('conditions'=>array('username' => $username))) == 0 && $this->User->find('count',array('conditions'=>array('email' => $email))) == 0){
					$this->User->set(array('username'=>$username,'email'=>$email,'password'=>$password,'level'=>$level));
					if($this->User->save()){
						$response = array('Success' => 1);
					}
				}else if($this->User->find('count',array('conditions'=>array('username' => $username))) != 0){
					$response = array('Success' => 0);
				}else if($this->User->find('count',array('conditions'=>array('email' => $email))) != 0){
					$response = array('Success' => -1);
				}
			}else{
				$response = array('Success' => -2);
			}
		}
		else{
			$response = array('Success' => -2);
		}
		return new CakeResponse(array('body' => json_encode($response)));
	}
	
	function delete($id = null){
		if($this->Session->read("User.username") && $this->Session->read("User.level") == 0){
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->User->delete()) {
				$this->Session->setFlash(__('User deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
		else
			$this->redirect(array('action' => 'index'));
	}
	
	function getInfo(){
		$data=$this->User->find('first',array('conditions'=>array('User.username'=>$this->Session->read($this->_sessionUsername))));
		$this->Session->write("User.id",$data["User"]["id"]);
		$this->Session->write("User.level",$data["User"]["level"]);
		$this->Session->write("User.firstname",$data["User"]["firstname"]);
		$this->Session->write("User.lastname",$data["User"]["lastname"]);
		
	}
	
	function profile($username){
		$this->set('user',$this->User->find('first',array('conditions'=>array('User.username'=>$username))));
		$categories = $this->getCategory();
		foreach($categories as $key=>$value){
			if(count($this->Point->find('first',array('conditions'=>array('Point.username'=>$username,'Point.category'=> $value)))) == 1){
				$point = $this->Point->find('first',array('conditions'=>array('Point.username'=>$username,'Point.category'=> $value)));
				$points[$key] = $point['Point']['point'];
			}else{
				$points[$key] = 0;
			}
		}
		$this->set('points',$points);
		$this->set('categories',$categories);
	}
	
	function updateprofile(){
		$error = '';
		$user = $this->User->find('first',array('conditions'=>(array('User.username'=>$this->Session->read('User.username')))));
		$this->User->id = $user['User']['id'];
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'profile',$this->Session->read('User.username')));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $user['User']['id']);
		}
	}
}?>