<html>
<??>
<body> 

	<span class="error"><?php //echo $error; ?></span> 

	<div class="block_label">
	<?=$this->Form->create('User', array('action' => 'updateprofile'));?>
	
	<?=$this->Form->input('firstname', array('label' => 'Firstname(*)','class' => 'large_input'));?>
	
	<?=$this->Form->input('lastname', array('label' => 'Lastname(*)','class' => 'large_input'));?>

	<?=$this->Form->input('dateofbirth', array('label' => 'Date of birth','type'=>'date'));?>

	<?=$this->Form->input('phone', array('label' => 'Phonenumber(*)', 'class' => 'large_input'));?>
	
	<?=$this->Form->input('email', array('label' => 'Email(*)','type'=>'email', 'class' => 'large_input'));?>
	
	<?=$this->Form->input('address', array('label' => 'Address(*)','type'=>'textarea', 'class' => 'large_input'));?>
	
	<br>
	<?=$this->Form->end('Update');?>
	</div>
</body> 
</html>