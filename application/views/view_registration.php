
	<?php $this->load->view("view_header"); ?>


	<?php // $this->load->view("view_categorysearch"); ?>


	<div class="wrap" style="margin-left:2em;">
	<p style = "color: #4aafcf; font-size: 1.5em; margin-bottom:25px;">Please fill up the registration form</p>
		<?php 

			if(isset($invalidmsg)) echo "<p>". $invalidmsg."</p>";

		     echo form_open('site/registration_validation');

		     echo validation_errors();

		     $data = array(
		     	'class'		=> 'form-control',
		     	'style'		=> 'max-width:300px;',
              'name'        => 'fname',
              'id'          => 'fname',
              'value'		=> $this->input->post('fname')
            );

		     echo "<p> First Name:  " ; 
		     echo form_input($data);
		     echo "</p>";

		     $data = array(
		     	'class'		=> 'form-control',
		     	'style'		=> 'max-width:300px;',
              'name'        => 'lname',
              'id'          => 'lname',
              'value'		=> $this->input->post('lname')
            );

		     echo "<p> Last Name:  " ; 
		     echo form_input($data);
		     echo "</p>";

		     $data = array(
		     	'class'		=> 'form-control',
		     	'style'		=> 'max-width:300px;',
              'name'        => 'email',
              'id'          => 'emailadd',
              'value'		=> $this->input->post('email')
            );

		     echo "<p> Email Address:  " ; 
		     echo form_input($data);
		     echo "</p>";


		     $data = array(
		     	'class'		=> 'form-control',
		     	'style'		=> 'max-width:300px;',
              'name'        => 'password',
              'id'          => 'passw',
            );

		     echo "<p> Password:  " ; 
		     echo form_password($data);
		     echo "</p>";

			$data = array(
				'class'		=> 'form-control',
		     	'style'		=> 'max-width:300px;',
              'name'        => 'confpassword',
              'id'          => 'confpassw',
            );

		     echo "<p>Confirm Password:  " ; 
		     echo form_password($data);
		     echo "</p>";		     

			
			$data = array(
				'class'		=> 'form-control',
		     	'style'		=> 'max-width:180px; display:inline;',
              'name'        => 'captcha',
              'id'          => 'captcha',
            );
			
			echo "<p>Enter Captcha: </p>";
			echo form_input($data) . "  ";
			echo $image;
			

			$data = array(
              'name'        => 'reg_submit',
              'id'          => 'regsub',
              'value'		=> 'Submit',
            );
		     echo "<p style=\" padding-top:10px;\"> " ; 
		     echo form_submit($data);
		     echo "</p>";
		     echo form_close();
		     ?>

	</div>

<?php $this->load->view("view_footer"); ?>