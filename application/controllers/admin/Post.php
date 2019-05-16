<?php  

	class Post extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->model('model_post');
			$this->load->model('model_profile');
			$this->load->library('pagination');

			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		public function index()
		{
			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
			else
			{
				$this->session->unset_userdata('sess_search_post');
      			$this->session->unset_userdata('sess_search_post2');

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
				$config["base_url"]    = base_url() . "admin/post/index/" . $limit;
				$config["total_rows"]  = $this->model_post->record_count();
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
				$data["post"]  	                        = $this->model_post->fetch_post($config["per_page"], $page);
				$data["column"] 	                    = $this->model_post->select_column_name($this->db->database);
				$data["links"]  	                    = $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/post/post', $data);
		
			}
		}

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
        			$this->session->set_userdata('sess_search_post', $data['cari']);
        			$this->session->set_userdata('sess_search_post2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_post');
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
      			$config["base_url"]             = base_url() . "admin/post/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]           = $this->model_post->record_count_search($data['cari'], $this->input->post('column_name'));
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
      			$data["post"]   					    = $this->model_post->fetch_post_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 						= $this->model_post->select_column_name($this->db->database);
      			$data["links"]  						= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/post/post', $data);
      
    		}
		}
		  
		public function insert_view()
		{
			$id_admin = $this->session->userdata('id_admin');

			$data['postcategory']  					= $this->model_post->fetch_postcategory();
			$data['admin']  						= $this->model_profile->getadmin($id_admin);
			$data['company']  						= $this->model_profile->getcompany();
			
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/topbar', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/post/post_insert', $data);
		}

  		#Insert Data
  		public function input() 
  		{
			$this->form_validation->set_rules('post_title','Judul Blog','required', array('required' => '*) Masukkan Judul Blog'));
			$this->form_validation->set_rules('postcategory_id','Kategori Blog','required', array('required' => '*) Pilih Kategori Blog'));
			$this->form_validation->set_rules('post_postby','Post By','required', array('required' => '*) Masukkan Penulis'));
			$this->form_validation->set_rules('post_desc','Deskripsi Post','required', array('required' => '*) Deskripsi wajib diisi'));
			$this->form_validation->set_rules('post_status','Status Post','required', array('required' => '*) Pilih salah satu'));
			
			if ($this->form_validation->run() === FALSE)
			{	
				$id_admin = $this->session->userdata('id_admin');

                $data['postcategory']  					= $this->model_post->fetch_postcategory();
                $data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/topbar', $data);

				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/post/post_insert', $data);
			} 
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					$data['post_id']       				= "";
					$data['post_title']     			= $this->input->post('post_title');
					$data['post_desc']     				= $this->input->post('post_desc');
					$data['post_slug']   				= slug($this->input->post('post_title'));
					$data['post_postby']   			    = $this->input->post('post_postby');
					$data['post_status']   			    = $this->input->post('post_status');
					$data['post_postdate'] 				= date('Y-m-d H:i:s');
                    $data['postcategory_id']   			= $this->input->post('postcategory_id');
                    
					$this->model_post->input($data);
	
					$this->session->set_flashdata('notif_insertpost','Post Baru Berhasil Di Tambahkan !');
					redirect('admin/post');
				}
				else
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/post/';
					$config['allowed_types']        		= 'gif|jpg|png|jpeg';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'post-img-'.$filename;	
	
					$this->load->library('upload', $config);
	
					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						
						$dat = $this->upload->data();
						
						$data['post_id']       				= "";
                        $data['post_title']     			= $this->input->post('post_title');
                        $data['post_desc']     				= $this->input->post('post_desc');
                        $data['post_slug']   				= slug($this->input->post('post_title'));
                        $data['post_postby']   			    = $this->input->post('post_postby');
						$data['post_status']   			    = $this->input->post('post_status');
						$data['post_postdate'] 				= date('Y-m-d H:i:s');						
                        $data['postcategory_id']   			= $this->input->post('postcategory_id');
                        $data['post_image']                 = $dat['file_name'];
                        
                        $this->model_post->input($data);
	
                        $this->session->set_flashdata('notif_insertpost','Post Baru Berhasil Di Tambahkan !');
                        redirect('admin/post');
			
					}
				}	
			}
		}
		  
		public function update_view()
		{
			$id = base64_decode($this->input->get('post_id'));
			
			$this->data['keys'] =  $this->model_post->get_edit($id);
			if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
			{
				redirect('admin/post');
			} 
			else 
			{
                $id_admin = $this->session->userdata('id_admin');
                
                $data['postcategory']  					= $this->model_post->fetch_postcategory();
				$data["keys"] 							= $this->model_post->get_edit($id);
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/post/post_update', $data);
			}
		}
		
  		#Update Data
  		public function edit() 
  		{
			$this->form_validation->set_rules('post_title','Judul Post','required');
			$this->form_validation->set_rules('postcategory_id','Kategori Post Post','required');
			$this->form_validation->set_rules('post_desc','Deskripsi Post','required');
			$this->form_validation->set_rules('post_postby','Post By','required');
			  
			$id = $this->input->get('post_id');

			if ($this->form_validation->run() === FALSE)
			{	
				$this->data['keys'] = $this->model_post->get_edit($this->input->post('post_id'));
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/post');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');
                    $id_post = $this->input->post('post_id');

                    $data['postcategory']  					= $this->model_post->fetch_postcategory();
					$data['keys'] 							= $this->model_post->get_edit($id_post);
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data['company']  						= $this->model_profile->getcompany();
					
					#Generate Template...
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/post/post_update', $data);
				}
			} 
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					$data['post_id']       				= $this->input->post('post_id');
					$data['post_title']     			= $this->input->post('post_title');
					$data['post_desc']     				= $this->input->post('post_desc');
					$data['post_slug']   				= slug($this->input->post('post_title'));
					$data['post_postby']   			    = $this->input->post('post_postby');
					$data['post_status']   			    = $this->input->post('post_status');
                    $data['postcategory_id']   			= $this->input->post('postcategory_id');

					$this->model_post->edit($data);

					$this->session->set_flashdata('notif_updatepost','Data Berhasil Di Ubah !');
					redirect('admin/post');
				}
				else
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/post/';
					$config['allowed_types']        		= 'gif|jpg|png|jpeg';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'post-img-'.$filename;	

					$this->load->library('upload', $config);

					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						$id_post = $this->input->post('post_id');
						$image = $this->model_post->link_gambar($id_post);

						if($image->num_rows() == 0)
						{
							$dat = $this->upload->data();
							
							$data['post_id']       				= $this->input->post('post_id');
							$data['post_title']     			= $this->input->post('post_title');
							$data['post_desc']     				= $this->input->post('post_desc');
							$data['post_slug']   				= slug($this->input->post('post_title'));
							$data['post_postby']   			    = $this->input->post('post_postby');
							$data['post_status']   			    = $this->input->post('post_status');
							$data['postcategory_id']   			= $this->input->post('postcategory_id');
							$data['post_image']                 = $dat['file_name'];
							
							$this->model_post->edit($data);
		
							$this->session->set_flashdata('notif_updatepost','Post<b> '.$data['post_title'].' </b>Berhasil Di Ubah !');
							redirect('admin/post');
						}
						else
						{
							if ($image->num_rows() > 0)
							{
								$row = $image->row();			
								$file_gambar = $row->post_image;
								$path_file = './img/post/';
								unlink($path_file.$file_gambar);
							}					
						
							$dat = $this->upload->data();
							
							$data['post_id']       				= $this->input->post('post_id');
							$data['post_title']     			= $this->input->post('post_title');
							$data['post_desc']     				= $this->input->post('post_desc');
							$data['post_slug']   				= slug($this->input->post('post_title'));
							$data['post_postby']   			    = $this->input->post('post_postby');
							$data['post_status']   			    = $this->input->post('post_status');
							$data['postcategory_id']   			= $this->input->post('postcategory_id');
							$data['post_image']                 = $dat['file_name'];
							
							$this->model_post->edit($data);
		
							$this->session->set_flashdata('notif_updatepost','Post<b> '.$data['post_title'].' </b>Berhasil Di Ubah !');							
							redirect('admin/post');
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