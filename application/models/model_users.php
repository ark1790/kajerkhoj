<?php

class Model_users extends CI_Model
{
	public function can_log_in()
	{
	
		$this->db->where('email', $this->input->post('email'));	
		$this->db->where('password', md5($this->input->post('password')));	

		$query = $this->db->get('users');

			if($query -> num_rows() == 1)
		   {
		     return true;
		   }
		   else
		   {
		     return false;
		   }

	}


	public function add_user()
	{
		$data = array(
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'lname' => $this->input->post('lname'),
			'fname' => $this->input->post('fname'),
			);

		$query= $this->db->insert('users',$data);

		if($query) return true; else return false;
	}

	public function get_user($email)

	{
		 $sql = "SELECT * FROM users WHERE email = ?"; 

		$query= $this->db->query($sql, array($email));
	
		
		 if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        else return 0;
	}
}