<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?=$title_for_layout;?> | Thuctap.com</title>
	<?=$this->Html->css('screen.css');?>
	<?=$this->Html->css('prettify.css');?>
	<?=$this->Html->script('prettify/prettify.js');?>
	<?=$this->Html->css('skin.css');?>
	<!--[if IE]>
	<style type="text/css">
	  .wrapper {
	    zoom: 1;     /* triggers hasLayout */
	    }  /* Only IE can see inside the conditional comment
	    and read this CSS rule. Don't ever use a normal HTML
	    comment inside the CC or it will close prematurely. */
	</style>
	<![endif]-->	

  <!--[if lte IE 6]><link rel="stylesheet" href="stylesheets/lib/ie.css" type="text/css" media="screen" charset="utf-8"><![endif]-->
</head>

<body onload="prettyPrint()">

<div id="page">

<div class="wrapper" id="header">
	<div class="wrapper">
		<div id="top_actions" class="top_actions">
			<ul class="tabs">
				
				
				<? if(!$this->Session->read("User.username")) { ?>
					<li>
						<?=$this->Html->link(
							__('Login',true),
							array('controller' => 'users', 'action' => 'login')
							);
						?>
					</li>
				<? } ?>
				
				
				<? if(!$this->Session->read("User.username")) { ?>
					<li>
						<?=$this->Html->link(
							__('Register',true),
							array('controller' => 'users', 'action' => 'register')
							);
						?>
					</li>
				<? } ?>
				
				<? if($this->Session->read("User.username")) { ?>
					<li>
						<?=$this->Html->link(
							__('hi, '.$this->Session->read("User.username"),true),
							array('controller' => 'users', 'action' => 'profile',$this->Session->read("User.username"))
							);
						?>
					</li>
					
				<? if($this->Session->read("User.username") && $this->Session->read("User.level") == 0) { ?>
				<li>
					<?=$this->Html->link(
							__('admin',true),
							array('controller' => 'users', 'action' => 'index')
						);
					?>
					<ul>
						<li>
							<?=$this->Html->link(
									ucfirst(__('Question Manager',true)),
									array('controller' => 'questions', 'action' => 'index')
								);
							?>
						</li>
				
						<li>
							<?=$this->Html->link(
									ucfirst(__('User Management',true)),
									array('controller' => 'users', 'action' => 'index')
								);
							?>
						</li>

					</ul>
				</li>
				<? } ?>
					
					<li>
						<?=$this->Html->link(
							__('Logout',true),
							array('controller' => 'users', 'action' => 'logout')
							);
						?>
					</li>
				<? } ?>
				
				
			</ul>
		</div>
	</div>
	
	<div class="wrapper">
		<a href="<?=$this->webroot; ?>"><?php echo $this->Html->image('images.jpg', array('alt' => 'Logo', 'id' => 'logo')); ?></a>
			
			<ul class="tabs">
				<li>
					<?=$this->Html->link(__('Quizz manager',true),'/posts/index');?>
				</li>
			</ul>
		
		<? if($this->Session->read("User.level") == 2) { ?>
		
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('Answer question',true),'/questions/setanswer/');?>
				</li>
			</ul>
		<?}?>
		
		<? if($this->Session->read("User.level") == 1) { ?>
			
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(
						__('My question',true),
						array('controller' => 'questions', 'action' => 'index')
						);
					?>
				</li>
			</ul>
			
		<?}?>
		
		<? if($this->Session->read("User.username") && $this->Session->read("User.level") == 0) { ?>
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('User manager',true),'/users');?>
				</li>
			</ul>
			
			<ul class="tabs" style="float: right;">
				<li>
					<?=$this->Html->link(__('Question manager',true),'/questions');?>
				</li>
			</ul>
		<?}?>
	</div>
	
	
	
</div>

<div id="body" class="wrapper">

			<?=$content_for_layout;?>

</div>
	
<div id="footer" class="wrapper">
		<div class="left">
			<ul class="tabs">
				<li>
				<?=$this->Html->link(__('home',true),'/');?>
				</li>
      
			</ul>
		</div>
</div>

</div>
</body>
</html>
