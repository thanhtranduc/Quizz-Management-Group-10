<?php
// class control information about post update, can adding and deleting post as admin
class PostsController extends AppController{
	var $name = "Posts"; // name of the post
    var $helpers = array("Html"); 
    var $component = array("Session");      
	var $paginate = array(
        'limit' => 20,
        'order' => array(
            'Post.id' => 'desc'
        )
    );

	function index(){
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}
	
	function my_post(){
		$this->paginate = array(
			'conditions'=>array('author' => $this->Session->read('User.username')),
			'limit' => 20,
			'order' => array('Post.id' => 'desc')
		);
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
		$this->render('index');
	}
	
	function view($id = null){
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}
	
	function add(){
		$pageTitle = 'Add';
		$error="";
		if($this->Session->read('level')!=1){
			if(!empty($this->data['Post']['text']) && !empty($this->data['Post']['content']) ){
				$title = $this->data['Post']['text']; 
				$content = $this->data['Post']['content'];
				$this->Post->set(array('title'=>$title,'content'=>$content,'author'=>$this->Session->read('User.username')));
				if($this->Post->save()){
					$this->redirect("index");
				}
			}
			else if(empty($this->data['Post'])){
				
			}
			else{
				$error = "Please fill title and content for post"; 
			}
        }    
        else 
            $this->redirect("index");
		$this->set("error",$error);
	}
	
	function delete($id = null){
		
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$this->Post->id = $id;
			$post = $this->Post->read(null,$id);
			if (!$this->Post->exists()) {
				throw new NotFoundException(__('Invalid Post'));
			}
			if(($this->Session->read("User.username") && $this->Session->read("User.level") == 0)|| $this->Session->read("User.username") == $post['Post']['author']){
				if ($this->Post->delete()) {
					$this->Session->setFlash(__('Post deleted'));
					$this->redirect(array('action' => 'index'));
				}
				else{$this->redirect(array('controller'=>'user','action' => 'login'));}
			}
			else{
				$this->Session->setFlash(__('Post was not deleted'));
				$this->redirect(array('action' => 'add'));
			}	
	}
}
?>