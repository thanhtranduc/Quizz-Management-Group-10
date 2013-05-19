<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<html>

<body> 
	<p>
		Register follow the below form(* is not empty):
	</p>

	<span class="error"><?php echo $error; ?></span> 

	<div class="block_label">
	<?=$this->Form->create('User', array('action' => 'register','method'=>'get'));?>
	
	<?=$this->Form->input('username', array('label' => 'Username(*)','class' => 'large_input'));?>

	<?=$this->Form->input('email', array('label' => 'Email(*)','class' => 'large_input'));?>

	<?=$this->Form->input('password', array('type' => 'Password', 'label' => 'Password(*)', 'class' => 'large_input'));?>
	
	<?=$this->Form->input('level',array('label' => "Account type",'type'=>'select','options'=>array(1 => 'Mod', 2 => 'Student'))); ?>
	<br>
	<?=$this->Form->end('Register');?>
	</div>
</body> 
</html>