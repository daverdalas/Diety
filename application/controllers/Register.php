<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends T01_Controller {

	public function index()
	{
        if( $this->isLoggedIn ) redirect('/', 'refresh');

        if( count($this->input->post()) > 0 )
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'email', 'required|max_length[255]|valid_email|callback_username_check');
            $this->form_validation->set_rules('pass1', 'hasło', 'required|min_length[6]|max_length[255]');
            $this->form_validation->set_rules('pass2', 'powt. hasła', 'required|max_length[255]|matches[pass1]');

            $this->form_validation->set_rules('name', 'imię', 'required|min_length[2]|max_length[255]');
            $this->form_validation->set_rules('surname', 'nazwisko', 'required|min_length[2]|max_length[255]');
            $this->form_validation->set_rules('phone', 'telefon', 'required|min_length[9]|max_length[255]|callback_phone_check');
            $this->form_validation->set_rules('addy', 'adres dostawy', 'required|min_length[3]');

            if( $this->input->post("company") != null )
            {
                $this->form_validation->set_rules('nip', 'nip', 'required|min_length[10]|max_length[255]|callback_nip_check');
                $this->form_validation->set_rules('fvat', 'adres firmy', 'required|min_length[3]');
            }

            if ($this->form_validation->run() == TRUE )
            {
                $this->load->model('Usermodel');
                $this->Usermodel->save( $this->input->post() );
                $this->show('registered');
                return;
            }
        }

		$this->show('register');
	}

    function activate( $uid, $token )
    {
        $this->load->model('Usermodel');
        $this->Usermodel->activate( $uid, $token );
        redirect('/login', 'refresh');
    }

    function username_check($str)
    {
        $this->load->model('Usermodel');

        if ( $this->Usermodel->get_hash( $str ) != null )
        {
            $this->form_validation->set_message('username_check', 'form_validation_t01_exists');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function phone_check($str)
    {
        $str = preg_replace( '/[^0-9]/','',$str );
        if ( strlen($str) > 11 || strlen($str) < 9 )
        {
            $this->form_validation->set_message('phone_check', 'form_validation_t01_phone');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function nip_check($str)
    {
        $str = preg_replace( '/[^0-9]/','',$str );
        if ( strlen($str) != 10 )
        {
            $this->form_validation->set_message('nip_check', 'form_validation_t01_nip');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
