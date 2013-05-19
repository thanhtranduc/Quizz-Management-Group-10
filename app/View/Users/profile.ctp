<html>
<?if(count($user)>0){?>
<?
$level = array('admin', 'mod of website', 'student');
?>
<? if($this->Session->read("User.username") == $user['User']['username'] ) { ?>
		
	<ul class="tabs" style="float: right;">
		<li>
			<?=$this->Html->link(__('Update my profile',true),array('action'=>'updateprofile'));?>
		</li>
	</ul>
			
<?}?>



<body>
<h2><?echo $user['User']['username'].'\'s profile';?></h2>
	Name: <?echo $user['User']['firstname'].' '.$user['User']['lastname'];?><br>
	Date of birth (yyyy-mm-dd): <?echo $user['User']['dateofbirth'];?><br>
	Phone number: <?echo $user['User']['phone'];?><br>
	Email: <?echo $user['User']['email'];?><br>
	Address: <?echo $user['User']['address'];?><br>
	Level: <?echo $level[$user['User']['level']];?><br>
	Johned at: <?echo $user['User']['created'];?><br>
<?if($this->Session->read('User.level') == 2){?>
<h2><?echo 'Point:';?></h2><br>
	
	<?foreach($categories as $key=>$value):{
		echo $value.': '.$points[$key];?>
	<br>
	<?}endforeach;?>
<?}?>
</body>
<?}else{?>
	<h2>User was not created</h2>
<?}?>
<html>