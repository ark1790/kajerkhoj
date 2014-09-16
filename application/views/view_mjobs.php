<?php $this->load->view("view_header"); ?>


<div class="wrap">
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
		<?php if ($results !=0) foreach($results as $rows)
		{
		 echo "<tr>
			<td id=\"cm". $rows->pid."\">". $rows->comname."</td>
			<td id=\"jt". $rows->pid."\">". $rows->jobtitle."</td>
			<td id=\"dl". $rows->pid."\">". $rows->deadline."</td>
			<td id=\"pi". $rows->pid."\">". $rows->postedin."</td>";
			if($this->session->userdata('is_logged_in'))
		  	echo "<td><input type=\"submit\" id=\"". $rows->pid."\" class=\"btn\" value=\"&#10003;&nbsp;Mark&nbsp;\"></td></tr>";
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
	<p><?php echo $links; ?></p>
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
	$(".btn").click(function(){
		var pid = this.id;
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