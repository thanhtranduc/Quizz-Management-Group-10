<html> 
<title>Home Page</title> 
<body> 

<div class="users index">
	<h2><?php echo __('Users Manager'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('level','Type'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<?php if($this->Session->read("User.username") && $this->Session->read("User.level")==0){ ?>
				<th class="actions"><?php echo __('Actions'); ?></th>
			<?php } ?>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php 
			if($user['User']['level'] == 0)
				echo h('Admin'); 
			else if($user['User']['level'] == 1)
				echo h('Mod');
			else if($user['User']['level'] == 2)
				echo h('Student');
		?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<?php if($this->Session->read("User.username") && $this->Session->read("User.level")==0){ ?>
			<td class="actions">
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete  %s?', $user['User']['username'])); ?>
			</td>
		<?php } ?>
	</tr>
<?php endforeach; ?>
	</table>
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