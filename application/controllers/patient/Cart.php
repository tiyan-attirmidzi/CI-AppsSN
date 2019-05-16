<?php


    class Cart extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model("model_login");
			$this->load->model("model_patient");
			$this->load->model("model_profile"); 	
			$this->load->model("model_transaction");
			$this->load->model("model_post");
			$this->load->model("model_package");
			$this->load->library('pagination');
        }

        public function index()
		{
			$id = $this->session->userdata('patient_id');
			if(!($this->session->userdata('patient_id')))
			{
				redirect('patient');
			}
			else
			{
				$this->session->unset_userdata('sess_search_package');
      			$this->session->unset_userdata('sess_search_package2');

      			if ($this->uri->segment(4) != "") 
      			{
			        $limit = $this->uri->segment(4);
			    } 
			    else 
			    {
			        $limit = 9;
			    }
			

				#Config for pagination...
				$config                = array();
				$config["base_url"]    = base_url() . "patient/cart/index/" . $limit;
				$config["total_rows"]  = $this->model_package->record_count();
				$config["per_page"]    = $limit;
				$config["uri_segment"] = 100;
			
				#Config css for pagination...
				$config['full_tag_open']   = '<ul class="pagination">';
				$config['full_tag_close']  = '</ul>';
				$config['first_link']      = "First";
				$config['last_link']       = "Last";
				$config['first_tag_open']  = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link']       = '&laquo';
				$config['prev_tag_open']   = '<li class="prev">';
				$config['prev_tag_close']  = '</li>';
				$config['next_link']       = '&raquo';
				$config['next_tag_open']   = '<li>';
				$config['next_tag_close']  = '</li>';
				$config['last_tag_open']   = '<li>';
				$config['last_tag_close']  = '</li>';
				$config['cur_tag_open']    = '<li class="active"><a href="#">';
				$config['cur_tag_close']   = '</a></li>';
				$config['num_tag_open']    = '<li>';
				$config['num_tag_close']   = '</li>';
			
				#Check Page in Segement 3...
				if ($this->uri->segment(5) == "") 
				{
					$data['number'] = 0;
				} 
				else 
				{
					$data['number'] = $this->uri->segment(5);
				}

				#Generate Pagination...
				$this->pagination->initialize($config);
				$page           					= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$data["links"]  					= $this->pagination->create_links();
				$data["column"] 					= $this->model_package->select_column_name($this->db->database);
				$data['patient'] 					= $this->model_patient->patient_track($id);
				$data['company']  					= $this->model_profile->getcompany();
				$data["package"]  					= $this->model_package->fetch_package($config["per_page"], $page);
				// $data["package"]             	    = $this->model_transaction->fetch_package();

				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/sidebar_patient', $data);
				$this->load->view('patient/cart', $data);
			}
		}

        //fungsi Add To Cart
		function add_to_cart()
		{ 
			$data = array(
				'id' => $this->input->post('package_id'), 
				'name' => $this->input->post('package_name'), 
				'price' => $this->input->post('package_price'), 
				'qty' => $this->input->post('quantity'), 
			);
			$this->cart->insert($data);
			echo $this->show_cart(); //tampilkan cart setelah added
		}
	
		//Fungsi untuk menampilkan Cart
		function show_cart()
		{ 
			$output = '';
			$no = 0;
			foreach ($this->cart->contents() as $items) {
				$no++;
				$output .='
					<tr>
						<td>'.$items['name'].'</td>
						<td>'.number_format($items['price']).'</td>
						<td>'.$items['qty'].'</td>
						<td>'.number_format($items['subtotal']).'</td>
						<td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
					</tr>
				';
			}
			$output .= '
				<tr>
					<th colspan="3">Total</th>
					<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
				</tr>
			';
			$output .= '
				<tr>
					<th colspan="5"><button type="button" id="" class="checkout_cart btn btn-success btn-block btn-lg">Checkout</button></th>
				</tr>
			';
			return $output;
		}
	
		 //load data cart
		function load_cart()
		{
			echo $this->show_cart();
		}
	
		 //fungsi untuk menghapus item cart
		function hapus_cart()
		{
			$data = array(
				'rowid' => $this->input->post('row_id'), 
				'qty' => 0, 
			);
			$this->cart->update($data);
			echo $this->show_cart();
		}

    }
    


?>