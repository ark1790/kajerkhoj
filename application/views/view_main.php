
<?php $this->load->view("view_header"); ?>

<div class = "wrap">

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active" style = "margin: 0 auto;">
      <img src="<?php echo base_url();?>resources/images/a.png" alt="Text1">
     
    </div>

     <div class="item">
      <img src="<?php echo base_url();?>resources/images/b.png" alt="Text2">
      
    </div>

     <div class="item">
      <img src="<?php echo base_url();?>resources/images/c.png" alt="Text3">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>

<div class = "row sform">

   <?php
		     $attributes = array('class' => '', 'role' => 'search', 'style' => 'margin:0 auto; text-align:center; margin-top:10px;');
		    echo form_open('site/searchresults',$attributes); ?>
		   <!-- <form class="navbar-form navbar-left navbar-right" role="search"> -->
		      
		        <input type="search" class="form-control" placeholder="Search" name ="search" style="min-width:61%;">
		        &nbsp;
		       
		      <button type="submit" class="btn btn-default">Search</button>
		    <?php echo form_close(); ?>
</div>

<div class = "row" style = "margin-top: 5em;">
<div class="col-md-4" style = "margin-bottom: 1em;"><a href = "#"><img class = "img-responsive shake" style= "margin: 0 auto; text-align:center;" src="<?php echo base_url();?>resources/images/android.png" alt="download application"></a></div>
<div class="col-md-4" style = "margin-bottom: 1em;"><a href = "#"><img class = "img-responsive shake" style= "margin: 0 auto; text-align:center;" src="<?php echo base_url();?>resources/images/facebook.png" alt="download application"></a></div>
<div class="col-md-4" style = "margin-bottom: 1em;"><a href = "#"><img class = "img-responsive shake" style= "margin: 0 auto; text-align:center;" src="<?php echo base_url();?>resources/images/twitter.png" alt="download application"></a></div>
</div>

</div>

<?php $this->load->view("view_footer"); ?>