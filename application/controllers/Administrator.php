<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	/*
	#Account 
		Type: 
		0: Participant with Paper
		1: Participant without Paper
		2: Sponsor

		#payment
		0: EUR
		1: USD

		#paper_status 

		0: Unreviewed
		1: summary inserted, 
		2: subject acceptance, 
		3: reviewed – ready to print, 
		4: rejected

		#presentation type:
		0: speaking
		1: poster session
	*/

	function auth()
	{
		if($this->session->userdata('admin_logged_in'))
		{
		    $session_data = $this->session->userdata('admin_logged_in');
		    $data['email'] = $session_data['email'];
	    }else{
		    return redirect('/administrator/login', 'refresh');
	    }
	}

	public function login()
	{
		if (isset($_POST['submit']))
		{

	       $user = $this->db->query('SELECT * from administrator WHERE email = ? LIMIT 1', array($_POST['email']));
	       $user = $user->row();

	       if ($user){
	       		if ($user->password == $_POST['password']){
	       			$sess_array = array('id' => $user->id, 'email' => $user->email);
	       			$this->session->set_userdata('admin_logged_in', $sess_array);
				 	return redirect('/administrator/statistics', 'refresh');
	       		} else{
	       			$this->session->set_flashdata('err_msg', 'Error, Invalid username or password.');
	       			return redirect('/administrator/login', 'refresh');
	       		}
	       }else{
	       		$this->session->set_flashdata('err_msg', 'You entered the wrong password or your account has changed.');
       			return redirect('/administrator/login', 'refresh');
	       }
		}	
		$this->load->view('administrator/login');
	}

	public function logout()
	{
		$this->session->unset_userdata('admin_logged_in');
		session_destroy();
		return redirect('/administrator/login', 'refresh');
	}

	public function add_participant()
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
				$this->session->set_flashdata('err_msg', 'This email is already registered');
       			return redirect('/administrator/add_participant', 'refresh');
			}
			
			// create participant account
			$res = $this->db->insert('account', $data_insert);
			$insert_id = $this->db->insert_id();

		
			// create payment record 
			if ($res){
				$data_insert_payment = array(
					'author' => $insert_id,
					'amount' => "0.00",
				);
				$res = $this->db->insert('payment', $data_insert_payment);
			}

			// send email 
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

			$this->session->set_flashdata('success_msg', 'You have successfully add new participant, the password has been send to the participant.');
			return redirect('/administrator/participants', 'refresh');
		}
			
		$this->load->view('administrator/participants/add_participant');
	}

	public function participants()
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$participants = $this->db->query("SELECT * FROM account ORDER BY id DESC");
		$this->load->view('administrator/participants/participants', array('participants' => $participants));
	}

	public function delete_participant($id)
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$participant = $this->db->query('SELECT * from account WHERE id = ? LIMIT 1', $id);
        $participant = $participant->row();

        // delete paper who related to participant
        $paper = $this->db->query('SELECT * from paper WHERE author = ?', $participant->id);
        if ($paper->num_rows() >= 1) {
        	foreach ($paper->result() as $data){
	        	// delete paper record
		        @unlink("./uploads/papers/".$date->file);
				$res = $this->db->delete('paper', array('author' => $participant->id));
			}
    	}

    	// delete payment who related to participant
        $payment = $this->db->query('SELECT * from payment WHERE author = ? LIMIT 1', $participant->id);
        if ($payment->num_rows() >= 1) {
        	$payment = $payment->row();
			$res = $this->db->delete('payment', array('author' => $participant->id));
    	}

        
		$res = $this->db->delete('account', array('id' => $participant->id));

		$this->session->set_flashdata('success_msg', 'Participant has successfully deleted');
		return redirect('/administrator/participants', 'refresh');
	}

	public function edit_participant($id)
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$user = $this->db->query('SELECT * from account WHERE id = ? LIMIT 1', array($id));
		$user = $user->row();

		if (isset($_POST['submit']) && isset($_POST['amount'])  ){
			$date_update = array(
				'amount' => $_POST['amount'],
				'currency' => $_POST['currency']	
			);

			$this->db->where('author', $user->id);
			$res = $this->db->update('payment', $date_update);


			$this->session->set_flashdata('success_msg', 'You have successfully edit participant');
			return redirect('administrator/edit_participant/'.$user->id, 'refresh');

		} 
		$this->load->view('administrator/participants/edit_participant', array('user' => $user));
	}

	public function confirm_participant_payment($id){
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');

		$user = $this->db->query('SELECT * from account WHERE id = ? LIMIT 1', array($id));
		$user = $user->row();

		$payment = $this->db->query('SELECT * from payment WHERE author = ? LIMIT 1', array($id));
		$payment = $payment->row();

		if ($payment->amount == "0.00"){
			$this->session->set_flashdata('err_msg', 'Payment cannot be changed, because amount is 0.00');
			return redirect('administrator/edit_participant/'.$id, 'refresh');
		}

		$data_update = array(
			'status' => $_GET["status"],
		);	

		$this->db->where('id', $payment->id);
		$this->db->update('payment', $data_update);
		$this->session->set_flashdata('success_msg', 'Payment status has been changed');
		return redirect('administrator/edit_participant/'.$id, 'refresh');

	}

	public function expense()
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$expense = $this->db->query("SELECT * FROM expense ORDER BY id ASC");
		$this->load->view('administrator/expense/expense', array('expense' => $expense));
	}

	public function add_expense()
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['expense_desc']) && isset($_POST['amount']) && isset($_POST['date']) ){
			$data_insert = array(
				'title' => $_POST['title'],
				'description' => $_POST['expense_desc'],
				'amount' => $_POST['amount'],
				'date' => date('Y-m-d H:i:s', strtotime( $_POST['date'])),
				'date_add' => date("Y-m-d h:i:s")
			);	

			$this->db->insert('expense', $data_insert);
			$this->session->set_flashdata('success_msg', 'The expense successfully added');
			return redirect('/administrator/expense', 'refresh');
		} 
		

		$this->load->view('administrator/expense/add_expense');
	}

	public function edit_expense($id)
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$expense = $this->db->query("SELECT * FROM expense WHERE id = ? LIMIT 1", array($id));
		$expense = $expense->row();
		
		if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['expense_desc']) && isset($_POST['amount']) && isset($_POST['date']) ){
			$date_update = array(
				'title' => $_POST['title'],
				'description' => $_POST['expense_desc'],
				'amount' => $_POST['amount'],
				'date' => date('Y-m-d H:i:s', strtotime( $_POST['date'])),
			);	

			$this->db->where('id', $id);
			$this->db->update('expense', $date_update);
			$this->session->set_flashdata('success_msg', 'The expense successfully edit');
			return redirect('/administrator/edit_expense/'.$id, array('expense' => $expense));
		} 
		
		$this->load->view('administrator/expense/edit_expense', array('expense' => $expense));
	}

	public function delete_expense($id)
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$expense = $this->db->query('SELECT * from expense WHERE id = ? LIMIT 1', $id);
        $expense = $expense->row();

		$res = $this->db->delete('expense', array('id' => $id));
		$this->session->set_flashdata('success_msg', 'The expense has been deleted');
		return redirect('/administrator/expense', 'refresh');

	}


	public function paper()
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$papers = $this->db->query('SELECT paper.id, account.name, account.surname, paper.title, paper.date_created, paper.paper_status FROM account INNER JOIN paper ON account.id=paper.author;');
		$this->load->view('administrator/paper/paper', array('papers' => $papers));
	}

	public function add_paper()
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$participants = $this->db->query("SELECT * FROM account");
		if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['summary']) && isset($_FILES['file']) ){
			

			$check_user = $this->db->query("SELECT * FROM account WHERE email = ? LIMIT 1", array($_POST['member']));
			if ($check_user->num_rows() == 1) {
				
				$check_user =$check_user->row(); 
				$data_insert = array(
					'author' => $check_user->id,
					'title' => $_POST['title'],
					'summary' => $_POST['summary'],
					'date_created' => date('Y-m-d')
				);	

				// file paper handler upload
				$random = uniqid(rand());
				$data_insert['file'] = $random.$_FILES["file"]["name"];	
				move_uploaded_file($_FILES['file']['tmp_name'], "./uploads/papers/".$random.$_FILES['file']['name']);

				// insert record to table
				$res = $this->db->insert('paper', $data_insert);

				// redirect to papers page
				$this->session->set_flashdata('success_msg', 'Your paper has been recorded');
				return redirect('administrator/paper', 'refresh');
				
			}else {
				$this->session->set_flashdata('err_msg', 'Please type the member email, The membes is not found');
				return redirect('administrator/add_paper', 'refresh');
			}

		}

		$this->load->view('administrator/paper/add_paper', array('participants' => $participants));
	}

	public function delete_paper($id)
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$paper = $this->db->query('SELECT * from paper WHERE id = ? LIMIT 1', $id);
        $paper = $paper->row();

        $delete_file = $this->db->query('SELECT file FROM paper WHERE id='.$id);
        $delete_file = $delete_file->row();
        @unlink("./uploads/papers/".$delete->file);
		$res = $this->db->delete('paper', array('id' => $id));

		$this->session->set_flashdata('success_msg', 'Paper has been deleted');
		return redirect('/administrator/paper', 'refresh');

	}

	public function edit_paper($id)
	{	
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$paper = $this->db->query('SELECT * from paper WHERE id = ? LIMIT 1', $id);
        $paper = $paper->row();

        if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['summary'])) {
        	$data_update = array(
				'title' => $_POST['title'],
				'summary' => $_POST['summary'],
				'review' => $_POST['review'],
				'paper_status' => $_POST['paper_status'],
				'presentation_type' => $_POST['presentation_type']
			);	

			$this->db->where('id', $id);
			$this->db->update('paper', $data_update);

        	// redirect to paper
			$this->session->set_flashdata('success_msg', 'Your paper has been changed');
			return redirect('administrator/edit_paper/'.$id, 'refresh');

		}
		$this->load->view('administrator/paper/edit_paper', array('paper' => $paper));
	}
	
	public function payments()
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$payments = $this->db->query('SELECT payment.id, account.name, account.surname, payment.amount, payment.currency, payment.status, payment.account_status FROM account INNER JOIN payment ON account.id=payment.author;');
		$this->load->view('administrator/payment/payment', array('payments' => $payments));
	}

	public function confirm_payment($id)
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$data_update = array(
			'account_status' => 1,
		);	

		$payment = $this->db->query('SELECT * from payment WHERE id = ? LIMIT 1', array($id));
		$payment = $payment->row();

		if ($payment->amount == "0.00"){
			$this->session->set_flashdata('err_msg', 'Payment cannot be changed, because amount is 0.00');
			return redirect('administrator/payments', 'refresh');
		}
		

		$this->db->where('id', $id);
		$this->db->update('payment', $data_update);
		$this->session->set_flashdata('success_msg', 'Payment has been confirmed');
		return redirect('administrator/payments', 'refresh');

	}
	

	public function mail()
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$participants = $this->db->query("SELECT * FROM account");
		$this->load->view('administrator/mailing/mail', array('participants' => $participants));
	}

	public function send_mail($id)
	{

		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');

		$member = $this->db->query("SELECT * FROM account WHERE id = ? LIMIT 1", array($id));
		$member = $member->row();


		
		if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['description'])) {


			// send email alone
			$msg = "<h4>Dear ".$member->name.",</h4>";
			$msg .= "<p>".$_POST['description']."</p>";

			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($this->config->item('email'), 'Conference Information');
			$this->email->to($member->email);
			$this->email->subject($_POST['title']);
			$this->email->message($msg);

			if(is_uploaded_file($_FILES['file']['tmp_name'])) {
				$file_name = $_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], "./uploads/files/".$file_name);
				$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$file_name);	
			}
			if ($this->email->send()){
				$this->session->set_flashdata('success_msg', 'Email successfully sent');
				return redirect('administrator/mail', 'refresh');
			} else {
				$this->session->set_flashdata('err_msg', 'Email failed to sent, try again');
				return redirect('administrator/send_mail/'.$id, 'refresh');
			}

		}

		$this->load->view('administrator/mailing/send_mail', array('member' => $member));
	}


	public function send_mail_selected()
	{

		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$this->load->library('email');

		$email =  $_GET['q'];
		$pieces = explode(" ", $email);
		
		if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['description'])) {

			$email =  $_GET['q'];
			$pieces = explode(" ", $email);

			if(is_uploaded_file($_FILES['file']['tmp_name'])) {
				$file_name = $_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], "./uploads/files/".$file_name);
				$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$file_name);	
			}

			foreach ($pieces as $list_mail) {
				
				$member = $this->db->query("SELECT * FROM account WHERE email = ? LIMIT 1", array($list_mail));
				$member = $member->row();

				$msg = "<h4>Dear ".$member->name.",</h4>";
				$msg .= "<p>".$_POST['description']."</p>";

				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from($this->config->item('email'), 'Conference Information');
				$this->email->to($list_mail);
				$this->email->subject($_POST['title']);
				$this->email->message($msg);

				if(is_uploaded_file($_FILES['file']['tmp_name'])) {
					$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$file_name);	
				}
				$this->email->send();

			}

			$this->session->set_flashdata('success_msg', 'Email successfully sent');
			return redirect('administrator/mail', 'refresh');


		}

		$this->load->view('administrator/mailing/send_mail_selected', array('pieces' => $pieces));
		
	}

	public function statistics()
	{
		$this->auth();
		$session_data = $this->session->userdata('admin_logged_in');
		$this->load->view('administrator/statistics');
	}
	
}




