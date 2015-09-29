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

            $this->form_validation->set_rules('name', 'imię', 'required|min_length[6]|max_length[255]');
            $this->form_validation->set_rules('surname', 'nazwisko', 'required|min_length[6]|max_length[255]');
            $this->form_validation->set_rules('phone', 'telefon', 'required|min_length[9]|max_length[255]|callback_phone_check');
            $this->form_validation->set_rules('addy', 'adres dostawy', 'required|min_length[6]');

            if( $this->input->post("company") == null )
            {
                $this->form_validation->set_rules('nip', 'nip', 'required|min_length[10]|max_length[255]|callback_nip_check');
                $this->form_validation->set_rules('fvat', 'adres fvat', 'required|min_length[6]');
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

    function username_check($str)
    {
        $this->load->model('Usermodel');

        if ( $this->Usermodel->get_hash( $str ) != null )
        {
            $this->form_validation->set_message('username_check', '%s is already at the database');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function phone_check($str)
    {
        if ( !preg_match( '/^\+?[0-9]+-?[0-9]+-?[0-9]+-?[0-9]+-?[0-9]*$/', trim($str) ) )
        {
            $this->form_validation->set_message('phone_check', '%s is not a valid phone');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function nip_check($str)
    {
        if ( !preg_match( '/^(\(d{3}-\d{3}-\d{2}-\d{2})|(d{3}-\d{2}-\d{2}-\d{3})$/', trim($str) ) )
        {
            $this->form_validation->set_message('nip_check', '%s is not a valid NIP');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
