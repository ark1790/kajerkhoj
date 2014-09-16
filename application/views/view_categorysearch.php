<div id="categories">
	
	<div class="content">

<h3><u>Categories</u></h3>  	
	<div id="catLink">
		<ul>

			<li><a href="<?php echo base_url();?>site/accountjobs" >Accounting/Finance</a></li>
			<li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=3" >Commercial/Supply Chain</a></li>
			<li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=4" >Education/Training</a></li>
			
		</ul>
	</div>
	<div id="catLink">
		<ul>

			<li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=5" >Engineer/Architects</a></li>
			<li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=6" >Garments/Textile</a></li>
			<li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=7" >General Management/Admin</a></li>
		</ul>
	</div>
    <div id="catLink">

        <ul>
            <li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=8" >IT/Telecommunication</a></li>
            <li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=9" >Marketing/Sales</a></li>
            <li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=16" >Customer Support/Call Centre</a></li>
        </ul>
    </div>
	<div id="catLink">

        <ul>
            <li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=11" >Medical/Pharmaceuticals</a></li>
			<li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=12" >NGO/Development</a></li>
            <li><a href="http://jobs.bdjobs.com/jobsbycategory.asp?cat=14" >Secretary/Receptionist</a></li>
        </ul>
    </div>

    
    
         </div>
	</div>
	
	<div id="search">
	<div id="horb" style="border-top:1px solid #ffffff;height:1em"></div>
	<?php echo form_open('site/searchresults'); 
	echo validation_errors();

	?>
		<input type="search" name ="search"> &nbsp;
		<input type="submit" name="btn-search" value="Search">
    <?php echo form_close(); ?>
	</div>