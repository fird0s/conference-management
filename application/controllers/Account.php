<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function auth()
	{
		if($this->session->userdata('logged_in'))
		{
		    $session_data = $this->session->userdata('logged_in');
		    $data['email'] = $session_data['email'];
	    }else{
		    return redirect('/account/login', 'refresh');
	    }
	}

	public function login()
	{
		if($this->session->userdata('logged_in'))
	   	{
		    $session_data = $this->session->userdata('logged_in');
		    $data['email'] = $session_data['email'];
		    return redirect('/account/profile', 'refresh');
	   	}

		if (isset($_POST['submit']))
		{

	       $user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($_POST['email']));
	       $user = $user->row();

	       if ($user){
	       		if ($user->password == $_POST['password']){
	       			$sess_array = array('id' => $user->id, 'email' => $user->email);
	       			$this->session->set_userdata('logged_in', $sess_array);
				 	return redirect('/account/profile', 'refresh');
	       		} else{
	       			$this->session->set_flashdata('err_msg', 'Error, Invalid username or password.');
	       			return redirect('/account/login', 'refresh');
	       		}
	       }else{
	       		$this->session->set_flashdata('err_msg', 'You entered the wrong password or your account has changed.');
       			return redirect('/account/login', 'refresh');
	       }
		}	
		$this->load->view('account/login');
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('account/login', 'refresh');
	}

	public function register()
	{
		if (isset($_POST['submit']) && isset($_POST['type']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['work']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['bill']) && isset($_POST['tax'])  ){
			$data_insert = array(
				'type' => $_POST['type'],
				'academic_title' => $_POST['title'],
				'name' => $_POST['name'],
				'surname' => $_POST['surname'],
				'email' => $_POST['email'],
				'work' => $_POST['work'],
				'address' => $_POST['address'],
				'phone' => $_POST['phone'],
				'password' => uniqid(rand()),
				'data_for_bill' => $_POST['bill'],
				'tax_number' => $_POST['tax']
			);
			
			if (isset($_POST['title'])) 
			{
				$data_insert['academic_title'] = $_POST['title'];
			}

			// check if email is not dupliate
			$check_user = $this->db->query("SELECT * FROM account WHERE email = ? ", array($_POST['email']));
			if ($check_user->num_rows() == 1) {
				$this->session->set_flashdata('err_msg', 'This email is already registered, please login');
       			return redirect('/account/register', 'refresh');
			}

			// send mail
			$msg = "<h3>Thank you for registering for the conference </h3><hr>";
			$msg .= "<h4>Dear ".$data_insert['name'].",</h4>";
			$msg .= "<p>You recently registered the conference. <a href=".base_url('index.php/account/login').">To login</a> please use password <b>".$data_insert['password']."</b>.</p>";
			$msg .= "<p>If you have any questions, don't hesitate to contact us via email <a href='mailto:".$this->config->item('email')."' target='_top'>".$this->config->item('email')."</a></p>";
			$msg .= "<p>Thank you, The Conference Team</p>";
			
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($this->config->item('email'), 'Conference Information');
			$this->email->to($data_insert['email']);
			$this->email->subject('Conference Registration');
			$this->email->message($msg);
			$this->email->send(); 

			$res = $this->db->insert('account', $data_insert);
			$insert_id = $this->db->insert_id();

			// add payment record 
			$data_insert_payment = array(
				'author' => $insert_id,
				'amount' => "0.00",
			);
			$res = $this->db->insert('payment', $data_insert_payment);
			$this->session->set_flashdata('success_msg', 'You have successfully registered, please check your email for get password.');

		} 
		$this->load->view('account/register');
	}

	public function profile()
	{
		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($session_data['email']));
		$user = $user->row();

		if (isset($_POST['submit']) && isset($_POST['type']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['work']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['bill']) && isset($_POST['tax'])  ){
			$date_update = array(
				'type' => $_POST['type'],
				'academic_title' => $_POST['title'],
				'name' => $_POST['name'],
				'surname' => $_POST['surname'],
				'email' => $_POST['email'],
				'work' => $_POST['work'],
				'address' => $_POST['address'],
				'phone' => $_POST['phone'],
				'data_for_bill' => $_POST['bill'],
				'tax_number' => $_POST['tax']
			);

			$this->db->where('email', $user->email);
			$res = $this->db->update('account', $date_update);

			// change session for email
			$sess_array = array(
			       'email' => $date_update['email']
		    );
		    $this->session->unset_userdata('logged_in');
			$this->session->set_userdata('logged_in', $sess_array);

			$this->session->set_flashdata('success_msg', 'You have successfully updated your profile');
			return redirect('account/profile', 'refresh');

		} 


		$this->load->view('account/profile', array('user' => $user));
	}

	public function change_pwd()
	{
		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($session_data['email']));
		$user = $user->row();

		if (isset($_POST['submit']) && isset($_POST['current_pwd']) &&  isset($_POST['new_pwd']) )
		{
			if ($user->password == $_POST['current_pwd']){
				$data_update = array('password' => $_POST['new_pwd']);
				$this->db->where("email", $user->email);
				$update = $this->db->update('account', $data_update);
				$this->session->set_flashdata('success_msg', 'Password has been changed');
				return redirect('account/change_pwd', 'refresh');
			}else{
				$this->session->set_flashdata('err_msg', 'Error while changing new password, please try again.');
				return redirect('account/change_pwd', 'refresh');
			}
		}	

		$this->load->view('account/change_pwd', array('user' => $user));
	}


	public function add_paper()
	{

		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($session_data['email']));
		$user = $user->row();

		if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['summary']) && isset($_FILES['file']) ){
			$data_insert = array(
				'author' => $user->id,
				'title' => $_POST['title'],
				'summary' => $_POST['summary'],
				'date_created' => date('Y-m-d')
			);	

			// file paper handler
			$random = uniqid(rand());
			$data_insert['file'] = $random.$_FILES["file"]["name"];	
			move_uploaded_file($_FILES['file']['tmp_name'], "./uploads/papers/".$random.$_FILES['file']['name']);

			// insert record to table
			$res = $this->db->insert('paper', $data_insert);

			// redirect to papers page
			$this->session->set_flashdata('success_msg', 'Your paper has been recorded');
			return redirect('account/papers', 'refresh');

		}


		$this->load->view('account/paper/add_paper', array('user' => $user));
	}

	public function papers()
	{
		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($session_data['email']));
		$user = $user->row();

		$papers = $this->db->query("SELECT * FROM paper WHERE author = ? ORDER BY id DESC", array($user->id));

		$this->load->view('account/paper/paper', array('papers' => $papers, 'user' => $user));
	}

	public function edit_paper($id)
	{

		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($session_data['email']));
		$user = $user->row();

		$paper = $this->db->query('SELECT * from paper WHERE id = ? LIMIT 1', $id);
        $paper = $paper->row();


        // cannot edit if paper not owner
        if ($paper->author != $user->id ){
        	// redirect to paper
			$this->session->set_flashdata('err_msg', 'You dont have permission to edit the paper');
			return redirect('account/papers/', 'refresh');
        }

        if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['summary'])) {
        	$data_update = array(
				'title' => $_POST['title'],
				'summary' => $_POST['summary'],
				'date_created' => date('Y-m-d')
			);	

        	$random = uniqid(rand());
			if (is_uploaded_file($_FILES["file"]["tmp_name"]))
			{	
				// remove img
				@unlink("./uploads/papers/".$paper->file);

				move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/papers/".$random.$_FILES["file"]["name"]);
				$data_update['file'] = $random.$_FILES["file"]["name"];	
			}

			$this->db->where('id', $id);
			$this->db->update('paper', $data_update);

        	// redirect to paper
			$this->session->set_flashdata('success_msg', 'Your paper has been changed');
			return redirect('account/edit_paper/'.$id, 'refresh');

		}
		
		$this->load->view('account/paper/edit_paper', array('paper' => $paper, 'user' => $user ));
	}


	public function delete_paper($id)
	{
		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($session_data['email']));
		$user = $user->row();

		$paper = $this->db->query('SELECT * from paper WHERE id = ? LIMIT 1', $id);
        $paper = $paper->row();

        // cannot delete if paper not owner
        if ($paper->author != $user->id ){
        	// redirect to paper
			$this->session->set_flashdata('err_msg', 'You dont have permission to edit the paper');
			return redirect('account/papers/', 'refresh');
        }

        $delete_file = $this->db->query('select file from paper where id='.$id);
        $delete_file = $delete_file->row();
        @unlink("./uploads/papers/".$delete->file);
		$res = $this->db->delete('paper', array('id' => $id));

		$this->session->set_flashdata('success_msg', 'Paper has been deleted');
		return redirect('/account/papers', 'refresh');
	}



	public function payments()
	{
		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($session_data['email']));
		$user = $user->row();

		$payment = $this->db->query('SELECT * from payment WHERE author = ? LIMIT 1', array($user->id));
		$payment = $payment->row();


		// if no record on payment table, then create it.
		if ($payment==NULL){
			$data_insert = array(
				'author' => $user->id,
			);
			$res = $this->db->insert('payment', $data_insert);
			return redirect('/account/payments', 'refresh');
		}


		// confirm payment form handler
		if (isset($_POST['submit']) && isset($_POST['amount']) && isset($_POST['currency'])) {
			$change_payment = array(
				'author' => $user->id,
				'amount' => $_POST['amount'],
				'date_confirmed' => date("Y-m-d h:i:sa"),
				'currency' => $_POST['currency'],
				'status' => 1
			);

			if ($change_payment['amount'] == "" or $change_payment['amount'] == "0.00"){
				$this->session->set_flashdata('err_msg', 'Please fill amount correctly');
				return redirect('/account/payments', 'refresh');				
			}

			$this->db->where('author', $user->id);
			$this->db->update('payment', $change_payment);

			$this->session->set_flashdata('success_msg', 'Paper has been deleted');
			return redirect('/account/payments', 'refresh');
		};


		$this->load->view('account/payment/payments', array('user' => $user, 'payment' => $payment ));
	}


	public function information()
	{
		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$user = $this->db->query('SELECT * from account WHERE email = ? LIMIT 1', array($session_data['email']));
		$user = $user->row();
		$this->load->view('account/information/information', array('user' => $user));
	}
	
}
