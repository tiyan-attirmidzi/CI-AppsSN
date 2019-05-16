<?php

    class Forgot extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
			$this->load->model("model_login");
			$this->load->model("model_profile");
        }

        public function index()
        {
            $data['token']  					= base64_decode($this->input->get('token'));
            $data['company']  					= $this->model_profile->getcompany();

            $this->load->view('forgot', $data);
        }

        public function reset()
        {
            $token                          = $this->input->post('token');

            // Nakes
            if($token == 2)
            {
                $email                  = $this->model_login->reset_nakes($this->input->post('email_user'));
                
                if ($email->num_rows() == 1)
				{
                    $from_email = "snalkobar.healthcenter@gmail.com"; 
                    $to_email = $email[0]->paramedic_email; 

                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => $from_email,
                        'smtp_pass' => 'snal12345678',
                        'charset'   => 'iso-8859-1'
                        );  

                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");   
            
                    $this->email->from($from_email, 'SN AL Kobar Health Center'); 
                    $this->email->to($to_email);
                    $this->email->subject('Test Pengiriman Email'); 
                    $this->email->message('Coba mengirim Email dengan CodeIgniter.'); 

                    //Send mail 
                    if($this->email->send())
                    {
                        $this->session->set_flashdata("notif","Email berhasil terkirim."); 
                    }
                    else 
                    {
                        $this->session->set_flashdata("notif","Email gagal dikirim."); 
                        $this->load->view('forgot'); 
                    } 
            
                }
                else
                {

                }
            }
            #END# Nakes

            // User
            if($token == 3)
            {
                $email                  = $this->model_login->reset_user($this->input->post('email_user'));
                $get                    = $this->model_login->get_user($this->input->post('email_user'));
                $pass_default           = 'reset-'.date('YmdHis').rand(10000,99999);
                
                if ($email->num_rows() == 1)
				{   
                    $to_email = $get[0]->user_email;

                    $mail = new PHPMailer(true);

                    $auth = true;

                    if ($auth) {
                    $mail->IsSMTP(); 
                    $mail->SMTPAuth = true; 
                    $mail->SMTPSecure = "ssl"; 
                    $mail->Host = "ssl://smtp.googlemail.com"; 
                    $mail->Port = 465; 
                    $mail->Username = "snalkobar.healthcenter@gmail.com"; 
                    $mail->Password = "snal12345678"; 
                    }

                    $mail->AddAddress("snalkobar.healthcenter@gmail.com");
                    $mail->SetFrom($get[0]->user_name, "John Deo");
                    $mail->isHTML(true);
                    $mail->Subject = "Test Email";
                    $mail->Body = "Hello World";

                    try {
                    $mail->Send();
                    return true;
                    } catch(Exception $e){
                    echo $mail->ErrorInfo;
                    }
                }
                else
                {

                }
            }
            #END# User

           

            
        }
    }

?>