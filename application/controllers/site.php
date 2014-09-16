<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {


public function index()
{

echo "Hi Internet <br/>";
$this->main();

}

public function addstuff()
{
	$this->load->model("math");
	echo $this->math->add();
}


public function home()
{
	$data['title'] = "Welcome to Kajer Khoj";
	$this->load->view("view_main" , $data);
}

public function main()
{
	$data['title'] = "Welcome to Kajer Khoj";
	$this->load->view("view_main" , $data);
}

public function about()
{
	$data['title'] = "About";
	$this->load->view("view_about" , $data);
}

public function login()
{
	$data['title'] = "About";
	$this->load->view("view_login" , $data);
}

public function yourmarkedjobs()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/yourmarkedjobs/";
$config['total_rows'] = $this->model_posts->mrecord_count();
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getmarkedposts($config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Jobs you have marked";
	$this->load->view('view_categories',$data);
}
	else
	redirect('site/login');	
}

public function login_validation()
{
	$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

		if ($this->form_validation->run())
		{

			$this->load->model('model_users');

	$s= $this->model_users->get_user($this->input->post('email'));

	

	foreach($s as $i)
	{
		$lastname = $i->lname;
		$firstname = $i->fname;
		$id = $i->id;
	}
	

			$data = array(
                   'email'     => $this->input->post('email'),
                   'is_logged_in' => TRUE,
                   'fname' => $firstname,
                   'lname' => $lastname,
                   'id' => $id
               );

			$this->session->set_userdata($data);

			redirect('site/yourmarkedjobs');
		}
		else
		{
			$this->load->view("view_login");
		}
}

public function validate_credentials()
{
	$this->load->model('model_users');


		if ($this->model_users->can_log_in())
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('validate_credentials', '* Incorrect email address/password');
			return FALSE;
		}
}

public function logout()
{
	$this->session->sess_destroy();
	redirect('site/main');
}

public function registration()
{
	$this->load->helper( 'captcha' );

			$vals = array(
        'img_path' => './captcha/',
        'img_url' => base_url() . 'captcha/',
        );
        
      $captcha = create_captcha($vals);
     $this->session->set_userdata('captchaWord', $captcha['word']);
     $captcha['invalidmsg'] ="";

	$this->load->view('view_registration',$captcha);
}

public function registration_validation()
{
	$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('confpassword', 'Confirm Password', 'required|trim|matches[password]');
		$this->form_validation->set_rules('lname', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('fname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('captcha', "Captcha", 'required');
		$this->form_validation->set_message('is_unique', 'E-mail Address already exist');
		
		$userCaptcha = $this->input->post('captcha');
		$word = $this->session->userdata('captchaWord');
        
		if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
		{

		$this->session->unset_userdata('captchaWord');
		$this->load->model('model_users');


		if ($this->model_users->add_user())
		{
			$data['msg'] = "Registration done sucessfully. You may now log in.";
			$this->load->view('view_default',$data);
		}
		else
		{
			echo "Registration Failed";
		}


			/*$key = md5(uniqid());
			$this->load->library('email', array('mailtype'=> 'html') );
			$this->email->from('accountactivation@kajerkhoj.com', "Kajer Khoj");
			$this->email->to($this->input->post('email'));
			$this->email->subject('Please Confirm Your Kajer Khoj Account');

			$message = "<p> Thank You for signing up";
			$message.= "<p><a href='".base_url()."site/register_user/$key'>Click Here to activate your account</a></p>";
			
			$this->email->message($message);	
			
			if($this->email->send())	
			{
				echo "Activation Key is being sent to your E-mail Address Successfully";
			}
			else echo "Sorry we failed to send E-mail"; */
		}
		else
		{
			
		$this->load->helper( 'captcha' );

			$vals = array(
        'img_path' => './captcha/',
        'img_url' => base_url() . 'captcha/',
        );
        
      $captcha = create_captcha($vals);
     $this->session->set_userdata('captchaWord', $captcha['word']);
     $captcha['invalidmsg'] ="Enter captcha text correctly";
	$this->load->view('view_registration',$captcha);
		}
}


public function accountjobs()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/accountjobs/";
$config['total_rows'] = $this->model_posts->record_count(1);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(1,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Account/Finance";
	$this->load->view('view_categories',$data);
}


public function commercial()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/commercial/";
$config['total_rows'] = $this->model_posts->record_count(2);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(2,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Commercial/Supply Chain";
	$this->load->view('view_categories',$data);
}

public function education()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/education/";
$config['total_rows'] = $this->model_posts->record_count(3);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(3,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Education/Training";
	$this->load->view('view_categories',$data);
}

public function engineer()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/engineer/";
$config['total_rows'] = $this->model_posts->record_count(4);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(4,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Engineer/Architect";
	$this->load->view('view_categories',$data);
}

public function garments()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/garments/";
$config['total_rows'] = $this->model_posts->record_count(5);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(5,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Garments/Textile";
	$this->load->view('view_categories',$data);
}

public function management()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/management/";
$config['total_rows'] = $this->model_posts->record_count(6);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(6,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "General Management/Admin";
	$this->load->view('view_categories',$data);
}

public function it()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/it/";
$config['total_rows'] = $this->model_posts->record_count(7);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(7,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "IT/Telecommunication";
	$this->load->view('view_categories',$data);
}

public function marketing()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/marketing/";
$config['total_rows'] = $this->model_posts->record_count(8);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(8,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Marketing/Sales";
	$this->load->view('view_categories',$data);
}

public function medical()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/medical/";
$config['total_rows'] = $this->model_posts->record_count(9);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(9,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Medical/Pharmaceuticals";
	$this->load->view('view_categories',$data);
}

public function development()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/development/";
$config['total_rows'] = $this->model_posts->record_count(10);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(10,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "NGO/Development";
	$this->load->view('view_categories',$data);
}

public function secretary()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/secretary/";
$config['total_rows'] = $this->model_posts->record_count(11);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(11,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Secretary/Receptionist";
	$this->load->view('view_categories',$data);
}

public function other()
{
	$this->load->library('pagination');
	$this->load->model('model_posts');
	$this->load->model('model_marks');

	$data['mark']= $this->model_marks->handle_viewmark($this->session->userdata('id'));

$config = array();
$config['base_url'] = base_url() . "site/other/";
$config['total_rows'] = $this->model_posts->record_count(12);
$config['per_page'] = 20; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->getposts(12,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Others";
	$this->load->view('view_categories',$data);
}

public function postaction()
{

	//print_r($_POST);

	//print_r ($this->session->all_userdata());
	//$this->load->model('model_marks');

	//$s= $this->model_marks->handle_mark($this->session->userdata('id'),$_POST['postid']);
	//$s = getpostdata(1);
	$s = $this->getpostdata($_POST);
	//echo $s;
	$arr =  array('check'=> $s, 'id'=>$this->session->userdata('id'));
	echo json_encode($arr);

}

public function getpostdata($s)
{
		$this->load->model('model_marks');

	$n= $this->model_marks->handle_mark($this->session->userdata('id'),$s);
	return $n;
}

public function searchresults()
{

	$keywords =  mysql_real_escape_string(htmlentities(trim($this->searchterm_handler($this->input->get_post('search', TRUE)))));
	

	$data = array();

	if(empty($keywords) || strlen($keywords) < 3 )
	{
		echo "Please Enter words atleast 3 letters long";
	}

	else
	{

$this->load->library('pagination');	
	$this->load->model('model_posts');	

	$config = array();
$config['base_url'] = base_url() . "site/searchresults/";
$config['total_rows'] = $this->model_posts->srecord_count($keywords);
$config['per_page'] = 6; 
$config["uri_segment"] = 3;
$this->pagination->initialize($config); 

$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$data['results'] = $this->model_posts->search_query($keywords,$config["per_page"], $page);
$data['links'] = $this->pagination->create_links();
$data['mark'] = 0;
$data['number'] = $config['total_rows'];
$data['headtitle'] = "Search Results";
	$this->load->view('view_categories',$data); 
	// print_r ($abcd);
	}

}

public function searchterm_handler($searchterm)
{
    if($searchterm)
    {
        $this->session->set_userdata('searchterm', $searchterm);
        return $searchterm;
    }
    elseif($this->session->userdata('searchterm'))
    {
        $searchterm = $this->session->userdata('searchterm');
        return $searchterm;
    }
    else
    {
        $searchterm ="";
        return $searchterm;
    }
}

public function testsearch()
{
	$this->load->view('view_default');
}

}
?>