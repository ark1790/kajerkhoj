<!--<div id="header">
		<div id="banner">
			<div id="logo"><img src="<?php echo base_url();?>resources/images/logo.png" alt="Logo"></div>
			<div id="navigation">
			<ul>
			<li><a href="<?php echo base_url();?>site/main">Home</a></li>
			<div id="verb" style="border-left:1px solid #dddddd;height:1em"></div>
			<li><a href="#">Job Analytics</a></li>
			<div id="verb" style="border-left:1px solid #dddddd;height:1em"></div>
			<li><a href="<?php echo base_url();?>site/registration">Registration</a></li>
			<div id="verb" style="border-left:1px solid #dddddd;height:1em"></div>
			<li><a href="<?php echo base_url();?>site/login">Log In</a></li>
			<ul>
			</div>
		</div>
		
	</div>
	<div class="clearfix"></div> -->

<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kajer Khoj</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>resources/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?php echo base_url();?>resources/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>resources/css/style2.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
       <script src="<?php echo base_url();?>resources/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url();?>resources/js/bootstrap.js"></script>

    <link rel=" shortcut icon" 
      type="image/png" 
      href="<?php echo base_url();?>resources/images/favicon.png">

  </head>

  <body>

  	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a  href="#"><img src="<?php echo base_url();?>resources/images/logo2.png" alt="Logo"></a>
		  </div>

		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav ">
		      <li><a href="<?php echo base_url();?>site/main">Home</a></li>

		      <li><a id="menu-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" href="#">Categories</a></li>

		      <?php

		      $name = $this->session->userdata('fname') . " " .  $this->session->userdata('lname');
	if($this->session->userdata('is_logged_in'))
	{
		echo "<li><a href=\"".base_url()."site/yourmarkedjobs\">Marked Jobs</a></li>";
		echo "<li><a href=\"".base_url()."site/main\">".$name."</a></li>";
	    echo "<li><a href=\"".base_url()."site/logout\">Logout</a></li>";
	}
	else
	{
		echo "<li><a href=\"".base_url()."site/login\">Login</a></li>
		      <li><a href=\"".base_url()."site/registration\">Registration</a></li> ";
	}
	  ?>
		      

		    </ul>


		  <form action="http://localhost/kajerkhoj/site/searchresults" method="post" accept-charset="utf-8" class=" navbar-form navbar-left navbar-right ssform" role="search">
		      <div class="form-group">
		        <input type="search" class="form-control" placeholder="Search" name ="search" style="min-width:250px;">
		        &nbsp;
		      </div> 
		      <button type="submit" class="btn btn-default">Search</button>
		    <?php echo form_close(); ?>
		  </div><!-- /.navbar-collapse -->
		</nav>
  
    <div id="wrapper">
      

       
      <!-- Sidebar -->
      <div style="margin-top: 3.65em"></div>

      <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <li style="color:#FFFFFF;"><a id="smenu-toggle" href="#">Hide Categories</a></li></li>
          
         <li><a href="<?php echo base_url();?>site/accountjobs" >Accounting/Finance</a></li>
		 <li><a href="<?php echo base_url();?>site/commercial" >Commercial/Supply Chain</a></li>
		 <li><a href="<?php echo base_url();?>site/education" >Education/Training</a></li>
		 <li><a href="<?php echo base_url();?>site/engineer" >Engineer/Architects</a></li>
		 <li><a href="<?php echo base_url();?>site/garments" >Garments/Textile</a></li>
		 <li><a href="<?php echo base_url();?>site/management" >General Management/Admin</a></li>
		 <li><a href="<?php echo base_url();?>site/it" >IT/Telecommunication</a></li>
         <li><a href="<?php echo base_url();?>site/marketing" >Marketing/Sales</a></li>
         <li><a href="<?php echo base_url();?>site/medical" >Medical/Pharmaceuticals</a></li>
		 <li><a href="<?php echo base_url();?>site/development" >NGO/Development</a></li>
		 <li><a href="<?php echo base_url();?>site/secretary" >Secretary/Receptionist</a></li>
         <li><a href="<?php echo base_url();?>site/other" >Others</a></li>
        </ul>
      </div>
          
      <!-- Page content -->
      
       
        <!-- Keep all page content within the page-content inset div! -->
        <div id="fix-for-navbar-fixed-top-spacing" style="height: 42px;">&nbsp;</div>
        <div class="page-content inset"> </div>



       	