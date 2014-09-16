<?php

class Model_marks extends CI_Model
{
	public function handle_mark($id,$s)
	{
		 $sql = "SELECT * FROM marks WHERE id = ? AND pid =?"; 


		$query= $this->db->query($sql, array($id,$s['postid']));
		
		 if ($query->num_rows() > 0) {
		 	$sql = "DELETE FROM marks WHERE id=? AND pid= ?";
		 	$query= $this->db->query($sql, array($id,$s['postid']));
            
            return 0;
        }
        else {
        	$data = array(
			   'id' => $id ,
			   'pid' => $s['postid'],
			   'jobtitle' => $s['jobtitle'],
			   'comname' => $s['comname'],
			   'deadline' => $s['deadline'],
			   'postedin' => $s['postedin']
			);

        	$this->db->insert('marks', $data); 

        	return 1;
        }

       
	}

	public function handle_viewmark($id)
	{
		 $sql = "SELECT pid FROM marks WHERE id = ?"; 

		$query= $this->db->query($sql, array($id));
		if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row) {
                $data[] = $row;
            					}
            return $data;
			}
		else return 0;		
	}
}