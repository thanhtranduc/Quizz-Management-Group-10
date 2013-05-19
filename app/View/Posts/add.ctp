	<span class="error"><?php echo $error; ?></span> 
	
	<div class="block_label">
	
	<?=$this->Form->create('Post', array('action' => 'add'));?>
	
	<?=$this->Form->input('text', array('label'=>'Title','class' => 'large_input'));?>
	
	<?=$this->Form->input('content', array('class' => 'large_input'));?>

	<?=$this->Form->end('Post');?>
	</div>