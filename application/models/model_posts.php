<?php

class Model_posts extends CI_Model
{
	public function getposts($cid,$limit,$start)
	{
		// $this->db->limit($limit, $start);
		 $query = $this->db->get_where('posts', array('cid' => $cid), $limit, $start);
	
		//$query = $this->db->query("SELECT comname,jobtitle,deadline,postedin FROM posts WHERE cid= ?" , array((int) $cid));
		
		 if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        else return false;
   
	}


	public function getmarkedposts($limit,$start)
	{
		// $this->db->limit($limit, $start);
		$id= $this->session->userdata('id');
		$sql = "SELECT * FROM marks WHERE id = ? LIMIT ?,?";
		 //$query = $this->db->get_where('posts', array('cid' => $cid), $limit, $start);
		$query= $this->db->query($sql, array($id,(int)$start,$limit));
		//$query = $this->db->query("SELECT comname,jobtitle,deadline,postedin FROM posts WHERE cid= ?" , array((int) $cid));
		
	 if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        else return false;
   
	}


    public function record_count($cid) {
        $query = $this->db->query("SELECT comname,jobtitle,deadline,postedin FROM posts WHERE cid= ?" , array((int) $cid));
        return $query->num_rows();
    }

     public function mrecord_count() {
     $id= $this->session->userdata('id');
      $sql = "SELECT * FROM marks WHERE id = ?"; 

		$query= $this->db->query($sql, array($id));
        return $query->num_rows();
    }

    public function srecord_count($keywords) {
     
     $keywords = preg_split('/[\s]+/', $keywords);

        $total = count($keywords);
        $where ="";
        foreach($keywords as $key=>$keyword)
        {
            $where .= "jobtitle LIKE '%$keyword%'";
            if ($key != $total-1) $where .= " OR "; 
        }
        $sql = "SELECT * from posts where $where";
        $query= $this->db->query($sql);
        return $query->num_rows();
    }

    public function search_query($keywords,$limit,$start)
    {
    	$keywords = preg_split('/[\s]+/', $keywords);

    	$total = count($keywords);
    	$where ="";
    	foreach($keywords as $key=>$keyword)
    	{
    		$where .= "jobtitle LIKE '%$keyword%'";
    		if ($key != $total-1) $where .= " OR "; 
    	}
    	$sql = "SELECT * from posts where $where LIMIT ?,?";
    	$query= $this->db->query($sql,array((int)$start,$limit));

    		 if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        else return false;
    	
    }
}