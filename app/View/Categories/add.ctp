	<span class="error"><?php echo $error; ?></span> 
	
	<div class="block_label">

	<?=$this->Form->create('Category', array('action' => 'add'));?>

	<?=$this->Form->input('name', array('type'=>'text','label'=>'Name','class' => 'large_input'));?>
	<?=$this->Form->input('describle', array('type'=>'textarea','label'=>'Describle','class' => 'large_input'));?>
	

	<?=$this->Form->end('Add this category');?>
	</div>