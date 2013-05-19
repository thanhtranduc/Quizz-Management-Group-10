<?php
class QuestionsController extends AppController{
	var $name = "Questions"; 
    var $helpers = array("Html"); 
    var $component = array("Session");
	var $uses = array('Question','Category','Answeredquestion','Point');
	var $paginate;
	
	
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
	
	function index($category = null){
		if($this->Session->read('User.username') && $this->Session->read('User.level') == 0){
			$this->redirect(array('action' => 'questionManager', $category));
		}else if($this->Session->read('User.level') == 1){
			$this->redirect(array('action' => 'myQuestion', $category));
		}
	}
	
	function questionManager($category =null){
		if($category == 0){
			$this->paginate = array(
				'limit' => 20,
				'order' => array(
					'Question.id' => 'desc'
				)
			);
		}else{
			$this->paginate = array(
				'conditions'=>array('category'=>$category),
				'limit' => 20,
				'order' => array(
					'Question.id' => 'desc'
				)
			);
		}
		$categories = $this->getCategory();
		$this->set('categories',$categories);
		$this->Question->recursive = 0;
		$questions = $this->paginate();
		$this->set('questions', $questions);
		$numofquestions[0] = count($this->Question->find('all'));
		foreach($categories as $key => $value){
			$numofquestions[$key] = count($this->Question->find('all', array('conditions'=> array('Question.category'=>$key))));
		}
		$this->set('numofquestions', $numofquestions);
		$this->render('index');
	}
	
	function myQuestion($category = null){
		if($category == 0){
			$this->paginate = array(
				'conditions'=>array('author' => $this->Session->read('User.username')),
				'limit' => 20,
				'order' => array(
					'Question.id' => 'desc'
				)
			);
		}else{
			$this->paginate = array(
				'conditions'=>array('category'=>$category,'author' => $this->Session->read('User.username')),
				'limit' => 20,
				'order' => array(
					'Question.id' => 'desc'
				)
			);
		}
		$categories = $this->getCategory();
		$this->set('categories',$categories);
		$this->Question->recursive = 0;
		$questions = $this->paginate();
		$this->set('questions', $questions);
		$numofquestions[0] = count($this->Question->find('all',array('conditions'=> array('Question.author'=>$this->Session->read('User.username')))));
		foreach($categories as $key => $value){
			$numofquestions[$key] = count($this->Question->find('all', array('conditions'=> array('Question.category'=>$key,'Question.author'=>$this->Session->read('User.username')))));
		}
		$this->set('numofquestions', $numofquestions);
		$this->render('index');
	}
	
	function view($id = null){
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		$this->set('question', $this->Question->read(null, $id));
	}
	
	function add(){
		$pageTitle = 'Add';
		$error="";
		$categories = $this->getCategory();
		$this->set('categories',$categories);
		if($this->Session->read('level')!=1){
			if(!empty($this->data['Question']['category']) && !empty($this->data['Question']['content']) && !empty($this->data['Question']['option1']) && !empty($this->data['Question']['option2']) && !empty($this->data['Question']['option3']) && !empty($this->data['Question']['option4'])){
				$category = $this->data['Question']['category'];
				$content = $this->data['Question']['content']; 
				$option1 = $this->data['Question']['option1'];
				$option2 = $this->data['Question']['option2'];
				$option3 = $this->data['Question']['option3'];
				$option4 = $this->data['Question']['option4'];
				$answer = $this->data['Question']['answer'];
				$this->Question->set(array('category'=>$category,'content'=>$content,'option1'=>$option1,'option2'=>$option2,'option3'=>$option3,'option4'=>$option4,'answer'=>$answer,'author'=>$this->Session->read('User.username')));
				if($this->Question->save()){
					$this->redirect("index");
				}
			}
			else if(empty($this->data['Question'])){
				
			}
			else{
				$error = "Please fill all blank field"; 
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
			$this->Question->id = $id;
			$question = $this->Question->read(null,$id);
			if (!$this->Question->exists()) {
				throw new NotFoundException(__('Invalid Question'));
			}
			if(($this->Session->read("User.username") && $this->Session->read("User.level") == 0)|| $this->Session->read("User.username") == $question['Question']['author']){
				if ($this->Question->delete()) {
					$this->Session->setFlash(__('Question deleted'));
					$this->redirect(array('action' => 'index'));
				}
			}
			else{
				$this->Session->setFlash(__('Question was not deleted'));
				$this->redirect(array('action' => 'index'));
			}	
	}
	
	function setanswer(){
		$categories = $this->getCategory();
		$categories[0] = 'All';
		$this->set('categories',$categories);
		
		if(!empty($this->data['Question'])){
			$numofquestion = $this->data['Question']['numofquestion']; 
			$category = $this->data['Question']['category'];
			$this->redirect(array('controller'=>'questions','action'=>'answerform',$numofquestion,$category));
		}
	}
	
	function getansweredID(){
		$answereds = $this->Answeredquestion->find('all',array('conditions'=>array('Answeredquestion.username'=>$this->Session->read('User.username'))));
		$i = 0;
		foreach($answereds as $answered){
			$answeredID[$i] = $answered['Answeredquestion']['question_id'];
			$i++;
		} 
		if(isset($answeredID))
			return $answeredID;
	}
	
	function answerform($numofquestion, $category){
		$answereds = $this->getansweredID();
		if($category == 0){
			$questions = $this->Question->find('all',array('order'=>array('rand()'),'limit'=>$numofquestion,'conditions'=>array('Question.id <>'=>$answereds)));
		}else{
			$questions = $this->Question->find('all',array('order'=>array('rand()'),'limit'=>$numofquestion,'conditions'=>array('Question.category'=>$category,'Question.id <>'=>$answereds)));
		}
		$this->set('questions',$questions);
		$this->set('answereds',$answereds);
		$categories = $this->getCategory();
		if(!empty($this->data['answer'])){
			$i= 1;
			$right=0;
			$result = 0;
			foreach ($questions as $question){
				$this->Answeredquestion->create();
				$this->Answeredquestion->set(array('username'=>$this->Session->read('User.username'),'question_id'=>$question['Question']['id']));
				if($this->Answeredquestion->save());
				if($this->data['answer']['chosen'.$i] == $question['Question']['answer']){
					$result ++;
					if($this->Point->find('count',array('conditions'=>array('Point.username'=>$this->Session->read('User.username'),'Point.category'=>$categories[$question['Question']['category']])))==0){
						$this->Point->create();
						$this->Point->set(array('username'=>$this->Session->read('User.username'),'category'=>$categories[$question['Question']['category']],'point'=>1));
						$this->Point->save();
					}else{
						$currentpoint = $this->Point->find('first',array('conditions'=>array('Point.username'=>$this->Session->read('User.username'),'Point.category'=>$categories[$question['Question']['category']])));
						$this->Point->id = $currentpoint['Point']['id'];
						$this->Point->set(array('username'=>$this->Session->read('User.username'),'category'=>$categories[$question['Question']['category']],'point'=>$currentpoint['Point']['point']+1));
						$this->Point->save();
					}
				}
				$i++;
			}
			$this->set('result',$result);
			$this->set('all',$i-1);
			$this->render('result');
		}else{
			
		}
		
	}
	
}
?>