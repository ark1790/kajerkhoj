<div id="header">
		<div id="banner">
			<div id="logo"><img src="<?php echo base_url();?>resources/images/logo.png" alt="Logo"></div>
			<div id="navigation">
			<ul>
			<li><a href="<?php echo base_url();?>site/main">Home</a></li>
			<div id="verb" style="border-left:1px solid #dddddd;height:1em"></div>
			<li><a href="<?php echo base_url();?>site/yourmarkedjobs">Marked Jobs</a></li>
			<div id="verb" style="border-left:1px solid #dddddd;height:1em"></div>
			<li><a href="#"><?php echo $this->session->userdata('fname') . " " . $this->session->userdata('lname') ; ?></a></li>
			<div id="verb" style="border-left:1px solid #dddddd;height:1em"></div>
			<li><a href="<?php echo base_url();?>site/logout">Logout</a></li>
			<ul>
			</div>
		
		</div>
		
	</div>
	<div class="clearfix"></div>
	<!--<div id="horb2" style="border-top:2px solid #6cd0f0;height:1em"></div>-->