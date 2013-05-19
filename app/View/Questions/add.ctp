	<span class="error"><?php echo $error; ?></span> 
	
	<div class="block_label">
	<?echo $categories[1];?>
	<?=$this->Form->create('Question', array('action' => 'add'));?>

	
	
	<?=$this->Form->input('category',array('type'=>'select','options'=>$categories)); ?>
	<?=$this->Form->input('content', array('class' => 'large_input'));?>
	
	<?=$this->Form->input('option1', array('type'=>'text','label'=>'Option A','class' => 'large_input'));?>
	<?=$this->Form->input('option2', array('type'=>'text','label'=>'Option B','class' => 'large_input'));?>
	<?=$this->Form->input('option3', array('type'=>'text','label'=>'Option C','class' => 'large_input'));?>
	<?=$this->Form->input('option4', array('type'=>'text','label'=>'Option D','class' => 'large_input'));?>
	
	<?=$this->Form->input('answer',array('type'=>'select','options'=>array(1 => 'A', 2 => 'B',3 => 'C',4 => 'D'))); ?>

	<?=$this->Form->end('Add this question');?>
	</div>