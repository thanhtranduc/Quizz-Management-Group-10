<html>
<?if (count($questions) == 0){?>
	<h1>Remain 0 new question in this category</h1>
	<? echo $this->Html->link(__('<<< Back to set answer form'), array('action' => 'setanswer')); ?>
<?}else{?>
	<h2>Answer there following questions:</h2>
	<?$i = 1;?>
	<?$chosen = array(1=>'A',2=>'B',3=>'C',4=>'D')?>
	<?=$this->Form->create('answer');?>
	<?foreach($questions as $question):?>
		Question<?echo $i.': '.$question['Question']['content'];?><br>
		A: <?echo $question['Question']['option1'];?><br>
		B: <?echo $question['Question']['option2'];?><br>
		C: <?echo $question['Question']['option3'];?><br>
		D: <?echo $question['Question']['option4'];?><br>
		<?echo 'chosen'.$i;?><?=$this->Form->input('chosen'.$i,array('label' => 'Your chose: ','type'=>'select','options'=>$chosen)); ?>
		<?$i++?><br>
	<?endforeach;?>
	<?=$this->Form->end('Done');?>
<?}?>
</html>