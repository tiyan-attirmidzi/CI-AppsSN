<?php  

	class Slider extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->model('model_slider');
			$this->load->model('model_profile');
			$this->load->library('pagination');

			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		#Index
		public function index()
		{
			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
			else
			{
				$this->session->unset_userdata('sess_search_slider');
      			$this->session->unset_userdata('sess_search_slider2');

      			if ($this->uri->segment(4) != "") 
      			{
			        $limit = $this->uri->segment(4);
			    } 
			    else 
			    {
			        $limit = 10;
			    }
			

				#Config for pagination...
				$config                = array();
				$config["base_url"]    = base_url() . "admin/slider/index/" . $limit;
				$config["total_rows"]  = $this->model_slider->record_count();
				$config["per_page"]    = $limit;
				$config["uri_segment"] = 5;
			
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
				
				$id_admin = $this->session->userdata('id_admin');

				#Generate Pagination...
				$this->pagination->initialize($config);
				$page           	                    = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$data["slider"]  	                    = $this->model_slider->fetch_slider($config["per_page"], $page);
				$data["column"] 	                    = $this->model_slider->select_column_name($this->db->database);
				$data["links"]  	                    = $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/slider/slider', $data);
		
			}
		}

		#Result (Search)
		public function result() 
		{
    		if (!($this->session->userdata('id_admin'))) 
    		{
                redirect('admin');
    		} 
    		else 
    		{
      			#Set Key Search to Session...
      			if ($this->input->post('key')) 
      			{
        			$data['cari'] = $this->input->post('key');
        			$this->session->set_userdata('sess_search_slider', $data['cari']);
        			$this->session->set_userdata('sess_search_slider2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_slider');
      			}
      
		      	#set Limit
		      	if ($this->uri->segment(4) != '') 
		      	{
		        	$limit = $this->uri->segment(4);
		      	} 
		      	else 
		      	{
		        	$limit = 10;
		      	}
      
      			#Config for pagination...
      			$config                         = array();
      			$config["base_url"]             = base_url() . "admin/slider/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]           = $this->model_slider->record_count_search($data['cari'], $this->input->post('column_name'));
      			$config["per_page"]             = $limit;
      			$config["uri_segment"]          = 6;
      
      			#Config css for pagination...
      			$config['full_tag_open']        = '<ul class="pagination">';
      			$config['full_tag_close']       = '</ul>';
      			$config['first_link']           = "First";
      			$config['last_link']            = "Last";
      			$config['first_tag_open']       = '<li>';
      			$config['first_tag_close']      = '</li>';
      			$config['prev_link']            = '&laquo';
      			$config['prev_tag_open']        = '<li class="prev">';
      			$config['prev_tag_close']       = '</li>';
      			$config['next_link']            = '&raquo';
      			$config['next_tag_open']        = '<li>';
      			$config['next_tag_close']       = '</li>';
      			$config['last_tag_open']        = '<li>';
      			$config['last_tag_close']       = '</li>';
      			$config['cur_tag_open']         = '<li class="active"><a href="#">';
      			$config['cur_tag_close']        = '</a></li>';
      			$config['num_tag_open']         = '<li>';
      			$config['num_tag_close']        = '</li>';
      
      			#Check Page in Segement 3...
      			if ($this->uri->segment(6) == "") 
      			{
        			$data['number'] = 0;
      			} 
      			else 
      			{
        			$data['number'] = $this->uri->segment(6);
      			}
				
				$id_admin = $this->session->userdata('id_admin');
				

      			#Generate Pagination...
      			$this->pagination->initialize($config);
      			$page           						= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
      			$data["slider"]   					    = $this->model_slider->fetch_slider_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 						= $this->model_slider->select_column_name($this->db->database);
      			$data["links"]  						= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/slider/slider', $data);
      
    		}
		}
		  
		public function insert_view()
		{
			$id_admin = $this->session->userdata('id_admin');

			$data['admin']  						= $this->model_profile->getadmin($id_admin);
			$data['company']  						= $this->model_profile->getcompany();
			
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/topbar', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/slider/slider_insert', $data);
		}

  		#Insert Data
  		public function input() 
  		{
			$this->form_validation->set_rules('slider_name','Nama Slider','required', array('required' => '*) Nama Slider wajib diisi'));
			$this->form_validation->set_rules('slider_status','Status Slider','required', array('required' => '*) Pilih Salah Satu'));
			$this->form_validation->set_rules('slider_desc','Deskripsi Slider','required', array('required' => '*) Deskripsi tidak Boleh kosong'));
			$this->form_validation->set_rules('userfile','Gambar','required', array('required' => '*) Masukkan Gambar'));
			
			if ($this->form_validation->run() === FALSE)
			{	
				$id_admin = $this->session->userdata('id_admin');

                $data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/slider/slider_insert', $data);
			} 
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					$data['slider_id']       				= "";
					$data['slider_name']     			    = $this->input->post('slider_name');
					$data['slider_desc']     				= $this->input->post('slider_desc');
					$data['slider_status']   				= $this->input->post('slider_status');
                    
					$this->model_slider->input($data);
	
					$this->session->set_flashdata('notif_success','Slider Baru Berhasil Di Tambahkan !');
					redirect('admin/slider');
				}
				else
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/slider/';
					$config['allowed_types']        		= 'gif|jpg|png|jpeg';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'slider-img-'.$filename;	
	
					$this->load->library('upload', $config);
	
					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						
						$dat = $this->upload->data();
						
						$data['slider_id']       				= "";
                        $data['slider_name']     			    = $this->input->post('slider_name');
                        $data['slider_desc']     				= $this->input->post('slider_desc');
                        $data['slider_status']   				= $this->input->post('slider_status');
                        $data['slider_image']                   = $dat['file_name'];
                        
                        $this->model_slider->input($data);
	
                        $this->session->set_flashdata('notif_success','Slider Baru Berhasil Di Tambahkan !');
                        redirect('admin/slider');
			
					}
				}	
			}
		}
		  
		public function update_view()
		{
			$id = base64_decode($this->input->get('slider_id'));
			
			$this->data['keys'] =  $this->model_slider->get_edit($id);
			if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
			{
				redirect('admin/slider');
			} 
			else 
			{
                $id_admin = $this->session->userdata('id_admin');
                
				$data["keys"] 							= $this->model_slider->get_edit($id);
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/slider/slider_update', $data);
			}
		}
		
  		#Update Data
  		public function edit() 
  		{
			$this->form_validation->set_rules('slider_name','Nama Slider','required', array('required' => '*) Nama Slider wajib diisi'));
			$this->form_validation->set_rules('slider_status','Status Slider','required', array('required' => '*) Pilih Salah Satu'));
			$this->form_validation->set_rules('slider_desc','Deskripsi Slider','required', array('required' => '*) Deskripsi tidak Boleh kosong'));
			  
			$id = $this->input->post('slider_id');

			if ($this->form_validation->run() === FALSE)
			{	
				$this->data['keys'] = $this->model_slider->get_edit($id);
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/slider');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');

					$data['keys'] 							= $this->model_slider->get_edit($id);
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data['company']  						= $this->model_profile->getcompany();
					
					#Generate Template...
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/slider/slider_update', $data);
				}
			} 
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					$data['slider_id']       				= $this->input->post('slider_id');
					$data['slider_name']     			    = $this->input->post('slider_name');
					$data['slider_desc']     				= $this->input->post('slider_desc');
					$data['slider_status']   				= $this->input->post('slider_status');

					$this->model_slider->edit($data);

					$this->session->set_flashdata('notif_success','Slider <b>'.$data['slider_name'].'</b> Berhasil Di Ubah !');
					redirect('admin/slider');
				}
				else
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/slider/';
					$config['allowed_types']        		= 'gif|jpg|png|jpeg';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'slider-img-'.$filename;	

					$this->load->library('upload', $config);

					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						$id_slider = $this->input->post('slider_id');
						$image = $this->model_slider->link_gambar($id_slider);

						if($image->num_rows() == 0)
						{
							$dat = $this->upload->data();
							
							$data['slider_id']       				= $this->input->post('slider_id');
                            $data['slider_name']     			    = $this->input->post('slider_name');
                            $data['slider_desc']     				= $this->input->post('slider_desc');
                            $data['slider_status']   				= $this->input->post('slider_status');
							$data['slider_image']                 = $dat['file_name'];
							
							$this->model_slider->edit($data);
		
							$this->session->set_flashdata('notif_success','Slider<b> '.$data['slider_name'].' </b>Berhasil Di Ubah !');
							redirect('admin/slider');
						}
						else
						{
							if ($image->num_rows() > 0)
							{
								$row = $image->row();			
								$file_gambar = $row->slider_image;
								$path_file = './img/slider/';
								unlink($path_file.$file_gambar);
							}					
						
							$dat = $this->upload->data();
							
							$data['slider_id']       				= $this->input->post('slider_id');
                            $data['slider_name']     			    = $this->input->post('slider_name');
                            $data['slider_desc']     				= $this->input->post('slider_desc');
                            $data['slider_status']   				= $this->input->post('slider_status');
							$data['slider_image']                   = $dat['file_name'];
							
							$this->model_slider->edit($data);
		
							$this->session->set_flashdata('notif_success','Slider<b> '.$data['slider_name'].' </b>Berhasil Di Ubah !');							
							redirect('admin/slider');
						}	
					}
				}
			}
  		}

  		 #Delete Data
 	 	public function delete() 
 	 	{
    		$this->model_blog->delete($this->input->post('blog_id'));
    		redirect('admin/blog');
  		}
	}



?>