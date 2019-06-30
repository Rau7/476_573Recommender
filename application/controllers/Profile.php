<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {

	

	public function index()
	{	
		if(isset($this->session->userdata['admin']['admin_id'])){
	    
	    $this->load->model("Book_model");
	    $data['read']=$this->Book_model->get_read_books($this->session->userdata['admin']['admin_name']);
	    $data['future']=$this->Book_model->get_future_books($this->session->userdata['admin']['admin_name']);
	    $data['readedbooks']=explode(',',$data['read'][0]['admin_read_id']);
	    $data['futurebooks']=explode(',',$data['future'][0]['admin_future_id']);

	    $cnt1=0;
	    foreach ($data['readedbooks'] as $key => $value) {
	    $data['real_reading'][$cnt1]=$this->Book_model->get_book_id($value);
	    $cnt1++;
	    }

	    $cnt2=0;
	    foreach ($data['futurebooks'] as $key => $value) {
	    $data['real_future'][$cnt2]=$this->Book_model->get_book_id($value);
	    $cnt2++;
	    }


		$data['userInfo']=$this->session->userdata['admin'];
		$data['subview'] = "profile";
		$data["title"]= "Profil";
		
		$this->load->view('layouts/standart',$data);
		 }
    else{
      header("Location: ".base_url());
    }
	}
	
	
	public function add_book_form(){
		if(isset($this->session->userdata['admin']['admin_id'])){
		$data['subview'] = "add_book_form";
		$data["title"]= "Kitap Ekle";

		$this->load->view('layouts/standart',$data);
		}
		    else{
		      header("Location: ".base_url());
		    }
		}

		public function book_adder(){
		if(isset($this->session->userdata['admin']['admin_id'])){

		$post_data['name'] =$this->input->post()['Ad'];
		$post_data['author'] =$this->input->post()['Yazar'];
		$post_data['genre'] = $this->input->post()['Tur'];
		$post_data['year'] = $this->input->post()['Yıl'];
		$post_data['read_by'] = $this->session->userdata['admin']['admin_name'];

		$this->load->model("Book_model");

		$this->Book_model->add_new_book($post_data);
		$the_id=$this->Book_model->get_book_id_name($post_data['name']);

		$data['read']=$this->Book_model->get_read_books($this->session->userdata['admin']['admin_name']);
		$data['readed']=$data['read'][0]['admin_read_id'].','.$the_id['book_id'];


		$this->Book_model->update_read_books($data['readed'],$this->session->userdata['admin']['admin_id']);

		redirect('http://localhost/bookstore/index.php/Profile','refresh');
		}
		    else{
			header("Location: ".base_url());
		    }
		}
	

	
	 public function recommendation($book_id){
		if(isset($this->session->userdata['admin']['admin_id'])){



		$data['subview'] = "reccom";
		$data["title"]= "Öneriler";

		$this->load->model("Book_model");
		$data['poster']['read']=$this->session->userdata['admin']['admin_name'];
		$data['poster']['id']=$book_id;
		$data['poster']['bname']=$this->Book_model->get_book_name($book_id)['book_name'];
		$data['poster']['bauthor']=$this->Book_model->get_book_author($book_id)['book_author'];
		$data['poster']['byear']=$this->Book_model->get_book_year($book_id)['book_year'];
		$data['poster']['bcategory']=$this->Book_model->get_book_category($book_id)['book_genre'];




		   $data['reccs']=$this->Book_model->get_recs($data['poster']);


		$this->load->view('layouts/standart',$data);

		}
		    else{
		      header("Location: ".base_url());
		    }
		}

		public function add_reading_book(){
		if(isset($this->session->userdata['admin']['admin_id'])){
		$this->load->model("Book_model");
		$data['subview'] = "profile";
		$data["title"]= "Kitap Ekle";

		$books=$this->input->post();
		$cnt=0;
		foreach ($books as $key => $value) {
		if($key!='Ekle'){
		$data['books'][$cnt]=$key;
		$cnt++;
		}
		}
		$data['future']=$this->Book_model->get_future_books($this->session->userdata['admin']['admin_name'])[0]['admin_future_id'];

		$cnt2=0;
		foreach ($data['books'] as $key => $value) {
		$data['future']=$data['future'].','.$value;
		}

		$this->Book_model->update_recs($data['future'],$this->session->userdata['admin']['admin_id']);

		$this->load->view('layouts/standart',$data);
		}
		    else{
		      header("Location: ".base_url());
		    }
		}
	
}

?>

