<?php  

	class Document extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();

			$this->load->model('model_document');
			$this->load->model('model_profile');
			$this->load->model('model_district');
			$this->load->library('pagination');
			$this->load->library('excel');

			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		#Index
		public function index()
		{
			$id = $this->session->userdata('id_admin');
			if(!($id))
			{
				redirect('admin');
			}
			else
			{
				$this->session->unset_userdata('sess_search_document');
      			$this->session->unset_userdata('sess_search_document2');

      			if ($this->uri->segment(4) != "") 
      			{
			        $limit = $this->uri->segment(4);
			    } 
			    else 
			    {
					$limit = 10;
			    }
			
				#Config for pagination...
				$config                					= array();
				$config["base_url"]    					= base_url() . "admin/document/index/" . $limit;
				$config["total_rows"]  					= $this->model_document->record_count();
				$config["per_page"]    					= $limit;
				$config["uri_segment"] 					= 5;
			
				#Config css for pagination...
				$config['full_tag_open']   				= '<ul class="pagination">';
				$config['full_tag_close']  				= '</ul>';
				$config['first_link']      				= "First";
				$config['last_link']       				= "Last";
				$config['first_tag_open']  				= '<li>';
				$config['first_tag_close'] 				= '</li>';
				$config['prev_link']       				= '&laquo';
				$config['prev_tag_open']   				= '<li class="prev">';
				$config['prev_tag_close']  				= '</li>';
				$config['next_link']       				= '&raquo';
				$config['next_tag_open']   				= '<li>';
				$config['next_tag_close']  				= '</li>';
				$config['last_tag_open']   				= '<li>';
				$config['last_tag_close']  				= '</li>';
				$config['cur_tag_open']    				= '<li class="active"><a href="#">';
				$config['cur_tag_close']   				= '</a></li>';
				$config['num_tag_open']    				= '<li>';
				$config['num_tag_close']   				= '</li>';
			
				#Check Page in Segement 5...
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
				$page           						= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$data["links"]  						= $this->pagination->create_links();
				$data["document"]  						= $this->model_document->fetch_document($config["per_page"], $page);
				$data["column"] 						= $this->model_document->select_column_name($this->db->database);
				$data['admin']  						= $this->model_profile->getadmin($id);
				$data['company']  						= $this->model_profile->getcompany();

				#Generate Template...
				$this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar', $data);
                $this->load->view('admin/document/content', $data);
			}
		}

		#Result (Search)
		public function result() 
		{
			$id = $this->session->userdata('id_admin');
			if(!($id))
			{
				redirect('admin');
			}
    		else 
    		{
      			#Set Key Search to Session...
      			if ($this->input->post('key')) 
      			{
        			$data['cari'] = $this->input->post('key');
        			$this->session->set_userdata('sess_search_document', $data['cari']);
        			$this->session->set_userdata('sess_search_document2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_document');
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
      			$config                					= array();
      			$config["base_url"]    					= base_url() . "admin/document/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]  					= $this->model_document->record_count_search($data['cari'], $this->input->post('column_name'));
      			$config["per_page"]    					= $limit;
      			$config["uri_segment"] 					= 6;
      
      			#Config css for pagination...
      			$config['full_tag_open']   				= '<ul class="pagination">';
      			$config['full_tag_close']  				= '</ul>';
      			$config['first_link']      				= "First";
      			$config['last_link']       				= "Last";
      			$config['first_tag_open']  				= '<li>';
      			$config['first_tag_close'] 				= '</li>';
      			$config['prev_link']       				= '&laquo';
      			$config['prev_tag_open']   				= '<li class="prev">';
      			$config['prev_tag_close']  				= '</li>';
      			$config['next_link']       				= '&raquo';
      			$config['next_tag_open']   				= '<li>';
      			$config['next_tag_close']  				= '</li>';
      			$config['last_tag_open']   				= '<li>';
      			$config['last_tag_close']  				= '</li>';
      			$config['cur_tag_open']    				= '<li class="active"><a href="#">';
      			$config['cur_tag_close']   				= '</a></li>';
      			$config['num_tag_open']    				= '<li>';
      			$config['num_tag_close']   				= '</li>';
      
      			#Check Page in Segement 3...
      			if ($this->uri->segment(6) == "") 
      			{
        			$data['number'] = 0;
      			} 
      			else 
      			{
        			$data['number'] = $this->uri->segment(6);
				}
      
      			#Generate Pagination...
      			$this->pagination->initialize($config);
      			$page           						= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["document"]   					= $this->model_document->fetch_document_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 						= $this->model_document->select_column_name($this->db->database);
      			$data["links"]  						= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id);
				$data['company']  						= $this->model_profile->getcompany();

				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/document/content', $data);
    		}
		}

  		#Insert Data
  		public function insert() 
  		{
			$this->form_validation->set_rules('document_name','Nama','required' , array('required' => '*) Masukkan Nama'));
			$this->form_validation->set_rules('document_desc','Deskripsi','required', array('required' => '*) Masukkan Deskripsi'));
			
			if ($this->form_validation->run() === FALSE)
			{	
				$id_admin = $this->session->userdata('id_admin');

				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				$data['district']  						= $this->model_district->getdistrict();
				
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/document/insert', $data);
			} 
			else
			{
				if($_FILES['userfile']['name']=='')
                {
                    #get data
                    $data['document_id']     					= "";
                    $data['document_name']     					= $this->input->post('document_name');
                    $data['document_desc']     					= $this->input->post('document_desc');
                    $data['document_status'] 					= $this->input->post('document_status');

                    $this->model_document->input($data);	
                    
                    // print_r($data);
                    $this->session->set_flashdata('notif_success','Dokumen Berhasil Di Tambahkan !');
                    redirect('admin/document');
                } 
                else 
                {
                    $filename                               = date('YmdHis');
                    $config['upload_path']          		= './document/';
                    $config['allowed_types']        		= '*';
                    $config['overwrite']                    ="true";
                    $config['max_size']                     ="20000000";
                    $config['max_width']                    ="10000";
                    $config['max_height']                   ="10000";
                    $config['file_name']                    = 'document-'.$filename;

                    $this->load->library('upload', $config);

                    if(!$this->upload->do_upload())
                    {
                        echo $this->upload->display_errors();
                    }
                    else 
                    {
                        $dat = $this->upload->data();
                            
                         #get data
                        $data['document_id']     					= "";
                        $data['document_name']     					= $this->input->post('document_name');
                        $data['document_desc']     					= $this->input->post('document_desc');
                        $data['document_status'] 					= $this->input->post('document_status');
                        $data['document_file']                     	= $dat['file_name'];

                        $this->model_document->input($data);
                        
                        $this->session->set_flashdata('notif_success','Dokumen Berhasil Di Tambahkan !');   
                        redirect('admin/document');
                        
                    }
                }
			}	
		}

		#View Update
		public function update_view()
		{
			$id = base64_decode($this->input->get('document_id'));
			
			$this->data['keys'] =  $this->model_document->get_edit($id);
			if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
			{
				redirect('admin/document');
			} 
			else 
			{
				$id_admin = $this->session->userdata('id_admin');
	
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data["keys"] 							= $this->model_document->get_edit($id);
				$data['company']  						= $this->model_profile->getcompany();
				$data['district']  						= $this->model_district->getdistrict();
				
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/document/update', $data);
			}
		}
		  
		#Update Data
		public function update()
		{
			$this->form_validation->set_rules('document_name','Nama','required' , array('required' => '*) Masukkan Nama'));
			$this->form_validation->set_rules('document_desc','Deskripsi','required', array('required' => '*) Masukkan Deskripsi'));

			$id = $this->input->post('document_id');

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['keys'] =  $this->model_document->get_edit($this->input->post('document_id'));
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/document');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');
	
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data["keys"] 							= $this->model_document->get_edit($this->input->post('document_id'));
					$data['company']  						= $this->model_profile->getcompany();
					$data['district']  						= $this->model_district->getdistrict();
					
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/document/update', $data);
				}
			}
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					#get data
					$data['document_id']     					= $this->input->post('document_id');
					$data['document_name']     					= $this->input->post('document_name');
                    $data['document_desc']     					= $this->input->post('document_desc');
                    $data['document_status'] 					= $this->input->post('document_status');

					$this->model_document->edit($data);		
					
					$this->session->set_flashdata('notif_success','Data Dokumen <b>'.$data['document_name'].'</b> Berhasil Di Ubah!');
					redirect('admin/document');
				} 
				else 
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './document/';
					$config['allowed_types']        		= '*';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'document-'.$filename;

					$this->load->library('upload', $config);

					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						if($this->input->post('document_file'))
						{			
							$file_gambar = $this->input->post('document_file');
							$path_file = './document/';
							unlink($path_file.$file_gambar);

							$dat = $this->upload->data();
						
							$data['document_id']     					= $this->input->post('document_id');
							$data['document_name']     					= $this->input->post('document_name');
							$data['document_desc']     					= $this->input->post('document_desc');
							$data['document_status'] 					= $this->input->post('document_status');
							$data['document_file']                     	= $dat['file_name'];

							$this->model_document->edit($data);

						}
						else
						{		
							$dat = $this->upload->data();
							
							$data['document_id']     					= $this->input->post('document_id');
							$data['document_name']     					= $this->input->post('document_name');
							$data['document_desc']     					= $this->input->post('document_desc');
							$data['document_status'] 					= $this->input->post('document_status');
							$data['document_file']                     	= $dat['file_name'];

							$this->model_document->edit($data);	
						}
						
						$this->session->set_flashdata('notif_success','Data Dokumen <b>'.$data['document_name'].'</b> Berhasil Di Ubah!'); 
						redirect('admin/document');
						
					}
				}
			}
		}

		
  		
		#Delete Data
 	 	public function delete() 
 	 	{
			if ($this->input->post('document_file'))
			{			
				$file_gambar = $this->input->post('document_file');
				$path_file = './document/';
				unlink($path_file.$file_gambar);
			}	
			$this->model_document->delete($this->input->post('document_id'));
			$this->session->set_flashdata('notif_success','Data Dokumen <b>'.$this->input->post('document_name').'</b> Telah Di Hapus!');
    		redirect('admin/document');
  		}

	}



?>