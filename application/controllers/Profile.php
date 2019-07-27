<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {

	

	public function index()
	{	
		if(isset($this->session->userdata['admin']['admin_id'])){
	    
	    $this->load->model("Book_model");
	    $data['read']=$this->Book_model->get_read_books($this->session->userdata['admin']['admin_name']);
	    $data['rating']=$this->Book_model->get_rating_books($this->session->userdata['admin']['admin_name']);
	    $data['readedbooks']=explode(',',$data['read'][0]['admin_read_id']);
	    $data['rating']=explode(',',$data['rating'][0]['admin_rating']);

	    $cnt1=0;
	    foreach ($data['readedbooks'] as $key => $value) {
	    $data['real_reading'][$cnt1]=$this->Book_model->get_book_id($value);
	    $cnt1++;
	    }

		$data['reccs']=	$this->converted($this->session->userdata['admin']['admin_name']);



		$data['userInfo']=$this->session->userdata['admin'];
		$data['subview'] = "profile";
		$data["title"]= "Profil";
		
		$this->load->view('layouts/standart',$data);
		 }
    else{
      redirect('http://localhost/bookstore/index.php/Login','refresh');
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
			redirect('http://localhost/bookstore/index.php/Login','refresh');
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

			public function book_order(){
		if(isset($this->session->userdata['admin']['admin_id'])){


		$data['sel']=$this->input->post()['Submit'];	

		$data['userInfo']=$this->session->userdata['admin'];
		$data['subview'] = "allthings";
		$data["title"]= "Tüm Kitaplar";

		$this->load->model("Book_model");

		if($data['sel']=="Tüm Kategoriler"){
			$data['reccs']=$this->Book_model->get_all_books();
		}
		else{
			$data['reccs']=$this->Book_model->get_all_books_with_cat($data['sel']);
		}

		$data['categories'] = $this->Book_model->get_categories();

		$this->load->view('layouts/standart',$data);

		
		}
		    else{
			redirect('http://localhost/bookstore/index.php/Login','refresh');
		    }
		}

	public function book_all(){

		if(isset($this->session->userdata['admin']['admin_id'])){

		$this->load->model("Book_model");
		$data['userInfo']=$this->session->userdata['admin'];
		$data['subview'] = "allthings";
		$data["title"]= "Tüm Kitaplar";

		$data['categories'] = $this->Book_model->get_categories();
		$data['reccs']=$this->Book_model->get_all_books();

		$this->load->view('layouts/standart',$data);


		}
		    else{
			redirect('http://localhost/bookstore/index.php/Login','refresh');
		    }
		}

		public function give_rating(){

		$this->load->model("Book_model");
		
		$data['reccs']=$this->Book_model->get_all_books();

		$data['readed'] = array_fill(0, 32, "");
		for ($k=0; $k < 32 ; $k++) { 
			$data['readed'][$k]= array (
		    "read_id"  => "",
		    "rating" => ""
			);
		}

		for ($i=0; $i < 32 ; $i++) { 

			for ($j=0; $j < 16 ; $j++) { 
				
				$data['readed'][$i]['read_id']=$data['reccs'][rand(0,15253)]['book_id'].",".$data['readed'][$i]['read_id'];
				$data['readed'][$i]['rating']=rand(2,10).",".$data['readed'][$i]['rating'];

			}

		}

		foreach ($data['readed'] as $key => $value) {
			$v=substr($value['read_id'],0,-1);
			$va=substr($value['rating'],0,-1);
			$data['readed'][$key]['read_id']=$v;
			$data['readed'][$key]['rating']=$va;
			
		}
		
		for ($i=0; $i < 32 ; $i++) { 
		
		$data['user'][$i]['admin_name']="admin".$i;
		$data['user'][$i]['admin_password']="123";
		$data['user'][$i]['admin_status']=1;
		$data['user'][$i]['admin_read_id']=$data['readed'][$i]['read_id'];
		$data['user'][$i]['admin_future_id']="";
		$data['user'][$i]['admin_rating']=$data['readed'][$i]['rating'];

		}
		
		$this->Book_model->give_rating_books($data['user']);

		}

	
}

?>

