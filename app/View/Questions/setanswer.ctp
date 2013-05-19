<html>
	<?echo 'Chose your form:';?><br>
	<?=$this->Form->create('Question', array('controller'=>'questions','action' => 'setanswer'));?>
	<?=$this->Form->input('numofquestion',array('label' => 'I want answer: ','type'=>'select','options'=>array(5 => '5 Questions', 6 => '6 Questions', 7 => '7 Questions', 8 => '8 Questions', 9 => '9 Questions', 10 => '10 Questions'))); ?>
	<?=$this->Form->input('category',array('label' => 'In category: ','type'=>'select','options'=>$categories)); ?>
	<?=$this->Form->end('Start');?>
</html>