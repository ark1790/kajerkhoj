<?php $this->load->view("view_header"); ?>
	

<div class="wrap">

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
<div style = "padding-bottom:35px;"></div>

<p style = "color: #4aafcf; font-size: 1.5em; margin-bottom:25px;"><?php echo $headtitle ?></p>
<p style= "font-size:0.91em; color:CCCCCC;"> <?php echo $number ?> results found </p>
  <?php echo form_open('site/postaction');?>
<table>
		<thead>
		<tr>
			<th>Company Name</th>
			<th>Job Title</th>
			<th>Deadline</th>
			<th>Posted in</th>
			
		<?php	if($this->session->userdata('is_logged_in'))
			echo "<th>Mark the Job</th>"; ?>
		</tr>
		</thead>
		<tbody>
		<?php if($results !=0) foreach($results as $rows)
		{
		 echo "<tr>
			<td id=\"cm". $rows->pid."\">". $rows->comname."</td>
			<td id=\"jt". $rows->pid."\">". $rows->jobtitle."</td>
			<td id=\"dl". $rows->pid."\">". $rows->deadline."</td>
			<td id=\"pi". $rows->pid."\">". $rows->postedin."</td>";
			if($this->session->userdata('is_logged_in'))
		  	echo "<td><input type=\"submit\" id=\"". $rows->pid."\" class=\"btnn\" value=\"&#10003;&nbsp;Mark&nbsp;\"></td></tr>";
		    else echo "</tr>";
		} ?>
		</tbody>
	</table>
	<?php echo form_close(); 

	if($mark !=0)
	foreach ($mark as $m) {
                $marks[] = $m->pid;
            }
           // print_r($marks);
	?>
	<p style = "font-size: 1.3em; font-weight: bold; padding-top:4px;"><?php echo $links; ?></p>
	
 </div>
	

<script type="text/javascript">
{
	var ptj = <?php echo json_encode($marks) ?>;
  $.each(ptj, function( index, value ) {
  //alert( index + ": " + value );
  $("#"+value).val($('<div>').html("<span style=\"font-size: 3em\">x</span> &nbsp;Unmark&nbsp;").text());
	}); 
}
</script>

<script type="text/javascript">
	$(".btnn").click(function(){
		var pid = this.id;
	//	alert($("#jt"+pid).html());
		var postData = {
			postid : pid,
			comname : $("#cm"+pid).html(),
			jobtitle : $("#jt"+pid).html(),
			deadline : $("#dl"+pid).html(),
			postedin : $("#pi"+pid).html(),
			postval : $("#"+pid).val()
		};

		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url();?>site/postaction", 
			data: postData,
			success: function(data)
			{
			//	alert(data);
				var result = $.parseJSON(data);
				//alert(result.check);
				if(result.check ==0) $("#"+pid).val($('<div>').html("&#10003;&nbsp;Mark&nbsp;").text());
				else $("#"+pid).val($('<div>').html("<span style=\"font-size: 3em\">x</span> &nbsp;Unmark&nbsp;").text());
			}
		})
	/*	.done(function(data){
			alert(data)
		}); */

	return false;
	});        
    </script>
<?php $this->load->view("view_footer"); ?>