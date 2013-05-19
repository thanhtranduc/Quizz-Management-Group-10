<html> 
<title>Home Page</title> 
<body> 
	<?=$this->Html->css('screen.css');?>
	<?=$this->Html->css('prettify.css');?>
	<?=$this->Html->script('prettify/prettify.js');?>
	<?=$this->Html->css('skin.css');?>

		<? if($this->Session->read("User.username") && $this->Session->read("User.level") == 1) { ?>
		
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('My Post',true),array('action'=>'my_post'));?>
				</li>
			</ul>
			
			<ul class="tabs" style="float: right;">
				<li>
					<?echo ' | ';?>
				</li>
			</ul>
			
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('New Post',true),array('action'=>'add'));?>
				</li>
			</ul>
			
		<?}?>

<div class="posts index">
	<h2><?php echo __('Post from mod'); ?></h2>
	<br>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('author'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<?php if( ($this->Session->read("User.username")&&$this->Session->read("User.level")==0)|| $this->Session->read("User.level")==1){ ?>
				<th class="actions"><?php echo __('Actions'); ?></th>
			<?php } ?>
	</tr>
	<?php
	foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $this->Html->link(__($post['Post']['title']),array('action' => 'view', $post['Post']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->Form->postLink(__($post['Post']['author']), array('controller' => 'users', 'action'=>'profile', $post['Post']['author'])); ?></td>
		<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php if(($this->Session->read("User.username") && $this->Session->read("User.level")==0)||($this->Session->read("User.username")==$post['Post']['author'])){ ?>
			
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete  %s?', $post['Post']['id'])); ?>
			
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