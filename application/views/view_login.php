
	<?php $this->load->view("view_header"); ?>


	<?php // $this->load->view("view_categorysearch"); ?>


	<div class="wrap" style="margin-left:2em;">
	<p style = "color: #4aafcf; font-size: 1.5em; margin-bottom:25px;">Enter your login credentials</p>
		<?php 

		     echo form_open('site/login_validation');

		     echo validation_errors();

		     $data = array(
		     'class'		=> 'form-control',
              'name'        => 'email',
              'id'          => 'emailadd',
              'style'		=> 'max-width:300px;'
            );


		     echo "  <div class=\"form-group\"><p> Email Address:  " ; 
		     echo form_input($data);
		     echo "</p> </div>";


		     $data = array(
		      'class'		=> 'form-control',
              'name'        => 'password',
              'id'          => 'passw',
              'style'		=> 'max-width:300px;'
            );

		     echo "<div class=\"form-group\"><p> Password:  " ; 
		     echo form_password($data);
		     echo "</p></div>";


		     $data = array(
              'name'        => 'login_submit',
              'id'          => 'logsub',
              'value'		=> 'Login',
            );

		     echo "<p> " ; 
		     echo form_submit($data);
		     echo "</p>";


		     echo form_close();

		 ?>

	</div>
	<?php $this->load->view("view_footer"); ?>