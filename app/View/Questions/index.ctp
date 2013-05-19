<html> 
<title>Home Page</title> 
<body> 
	<?=$this->Html->css('screen.css');?>
	<?=$this->Html->css('prettify.css');?>
	<?=$this->Html->script('prettify/prettify.js');?>
	<?=$this->Html->css('skin.css');?>
<div class="categories index">
	<? if($this->Session->read("User.username") && $this->Session->read("User.level") == 0 ) { ?>
		
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('New category',true),array('controller'=>'categories','action'=>'add'));?>
				</li>
			</ul>
			
		<?}?>
	<h2><?php echo __('Categories'); ?></h2>
	<br>
	<?php echo $this->Form->postLink(__('All ('.$numofquestions[0].')'), array('action' => 'index', 0)); ?>
	<br>
	<?php foreach ($categories as $key => $value):?>
	<?php echo $this->Form->postLink(__($value.'('.$numofquestions[$key].')'), array('action' => 'index', $key));?>
	<br>
	<?endforeach;?>
	<br>
</div>	

<div class="questions index">
		<? if($this->Session->read("User.username") && ($this->Session->read("User.level") == 0 || $this->Session->read("User.level") == 1) ) { ?>
		
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('New Question',true),array('action'=>'add'));?>
				</li>
			</ul>
			
		<?}?>
	<h2><?php echo __('Questions'); ?></h2>
		
	<br>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('category'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('option1', 'option A'); ?></th>
			<th><?php echo $this->Paginator->sort('option2', 'option B'); ?></th>
			<th><?php echo $this->Paginator->sort('option3', 'option C'); ?></th>
			<th><?php echo $this->Paginator->sort('option4', 'option D'); ?></th>
			<th><?php echo $this->Paginator->sort('answer'); ?></th>
			<th><?php echo $this->Paginator->sort('author'); ?></th>
			<?php //if( && $this->Session->read("User.level")==1){ ?>
				<th class="actions"><?php echo __('Actions'); ?></th>
			<?php //} ?>
	</tr>
	<?php
	$answer = array(1=>'A',2=>'B',3=>'C',4=>'D');
	foreach ($questions as $question): ?>
	<tr>
		<td><?php echo h($categories[$question['Question']['category']]); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['content']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['option1']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['option2']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['option3']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['option4']); ?>&nbsp;</td>
		<td><?php echo h($answer[($question['Question']['answer'])]); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['author']); ?>&nbsp;</td>
		<td class="actions">
			<?php if(($this->Session->read("User.username") && $this->Session->read("User.level")==0)||($this->Session->read("User.username")==$question['Question']['author'])){ ?>
			
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete  %s?', $question['Question']['id'])); ?>
			
			<?php } ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<br>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous').'  ', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('  '.'separator' => ''));
		echo $this->Paginator->next('  '.__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

</body> 
</html>