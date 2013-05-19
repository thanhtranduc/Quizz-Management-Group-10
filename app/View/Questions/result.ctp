<?$chosen = array(1=>'A',2=>'B',3=>'C',4=>'D')?>
<h2><?echo 'Your result is: '.$result.'/'.$all;?></h2><br>
<? echo $this->Html->link(__('<<< Back to set answer form'), array('action' => 'setanswer')); ?><br>
<br>
<?$i = 1;?>
<?foreach($questions as $question):?>
		Question<?echo $i.': '.$question['Question']['content'];?><br>
		A: <?echo $question['Question']['option1'];?><br>
		B: <?echo $question['Question']['option2'];?><br>
		C: <?echo $question['Question']['option3'];?><br>
		D: <?echo $question['Question']['option4'];?><br>
		The answer is: <?echo $chosen[($question['Question']['answer'])];?><br>
		<br>
		<?$i++?>
<?endforeach;?>
