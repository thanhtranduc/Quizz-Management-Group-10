	<? if($this->Session->read("User.username") && $this->Session->read("User.level") == 1) { ?>
		
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('My Post',true),'/my_post');?>
				</li>
			</ul>
			
			<ul class="tabs" style="float: right;">
				<li>
					<?echo ' | ';?>
				</li>
			</ul>
			
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('New Post',true),'/add');?>
				</li>
			</ul>
			
		<?}?>
<div class = "posts view">
<h2><?php  echo __('Post'); ?></h2>
	<dl>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($post['Post']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo $post['Post']['content']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Author'); ?></dt>
		<dd>
			<?php echo h($post['Post']['author']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($post['Post']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>