<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 01.10.15
 * Time: 15:25
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class User_panel extends T01_Controller {

    public function index( )
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');

        $this->load->model('Ordermodel');
        $plans = $this->Ordermodel->get_plan( $this->session->userdata['user']->id, array('A') );
        $calendars = $this->Ordermodel->get_callendar( $this->session->userdata['user']->id );

        $this->show('panels/user/index', array( 'orders' => $plans, 'calendars' => $calendars ));
    }

    public function history( $uid = 0 )
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        if( $uid == 0 ) $uid = $this->session->userdata['user']->id;
        if( !$this->isAdmin )
        {
            if( $this->session->userdata['user']->id != $uid )
                redirect('/user_panel', 'refresh');
        }

        $this->load->model('Ordermodel');
        $this->show(
            'panels/user/history',
            array( 'orders' => $this->Ordermodel->get_order( $uid ) ),
            true
        );
    }

    function edit_user( $uid = 0 )
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');

        if( $uid == 0 ) $uid = $this->session->userdata['user']->id;
        if( !$this->isAdmin )
        {
            if( $this->session->userdata['user']->id != $uid )
                redirect('/user_panel', 'refresh');
        }

        $this->load->model('Usermodel');
        $user = $this->Usermodel->fetch_user( $uid );
        if( $user == null ) redirect('/user_panel', 'refresh');

        if( count($this->input->post()) > 0 )
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'imię', 'required|min_length[2]|max_length[255]');
            $this->form_validation->set_rules('surname', 'nazwisko', 'required|min_length[2]|max_length[255]');
            $this->form_validation->set_rules('phone', 'telefon', 'required|min_length[9]|max_length[255]|callback_phone_check');
            $this->form_validation->set_rules('addy', 'adres dostawy', 'required|min_length[3]');

            if( $this->input->post("company") != null )
            {
                $this->form_validation->set_rules('nip', 'nip', 'required|min_length[10]|max_length[255]|callback_nip_check');
                $this->form_validation->set_rules('fvat', 'adres fvat', 'required|min_length[3]');
            }

            if ($this->form_validation->run() == TRUE )
            {
                $this->Usermodel->update( $uid, $this->input->post() );
                redirect('/user_panel', 'refresh');
            }
        }

        $this->show( 'panels/user/edit_user', array( 'user' => $user ) );
    }

    public function edit( $id )
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        $this->load->model('Ordermodel');

        if( !$this->isAdmin )
        {
            if( !$this->Ordermodel->checkPlanOwner( $id, $this->session->userdata['user']->id ) )
                redirect('/user_panel', 'refresh');
        }

        if( count($this->input->post()) > 0 )
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'email', 'required|max_length[255]|valid_email');
            $this->form_validation->set_rules('name', 'imię', 'required|min_length[2]|max_length[255]');
            $this->form_validation->set_rules('surname', 'nazwisko', 'required|min_length[2]|max_length[255]');
            $this->form_validation->set_rules('phone', 'telefon', 'required|min_length[9]|max_length[255]|callback_phone_check');

            if( $this->input->post("weekends") != null )
            {
                $this->form_validation->set_rules('addy2', 'adres dostawy', 'required|min_length[3]');
                $this->form_validation->set_rules('from1', 'od', 'required|integer|numeric|greater_than[5]|less_than[11]');
                $this->form_validation->set_rules('to1', 'do', 'required|integer|numeric|greater_than['.$this->input->post("from").']|less_than[12]');
            }

            $this->form_validation->set_rules('addy', 'adres dostawy', 'required|min_length[3]');
            $this->form_validation->set_rules('from', 'od', 'required|integer|numeric|greater_than[5]|less_than[11]');
            $this->form_validation->set_rules('to', 'do', 'required|integer|numeric|greater_than['.$this->input->post("from").']|less_than[12]');

            if ($this->form_validation->run() == TRUE ) {
                $orders = $this->Ordermodel->update(
                    $this->input->post()
                );
                $this->Ordermodel->calendar( $this->session->userdata['user']->id );

                $this->load->library('email');
                $this->email->from( $_SERVER['___MAIL_USER'], 'cooking.pl' );
                $this->email->to( $this->session->userdata['user']->email );
                $this->email->subject('Zmiana w planie abonamentu');
                $this->email->message(
                    $this->load->view(
                        'email/change',
                        array(
                            'plan' => $this->input->post()
                        ),
                        true
                    )
                );
                $this->email->send();

                redirect('/user_panel/history', 'refresh');
            }
        }

        $orders = $this->Ordermodel->get_plan(
            null,
            array('W', 'A'),
            $id
        );
        if ($orders == null) redirect('/user_panel/history', 'refresh');

        $this->show( 'panels/user/edit_order', array( 'order' => $orders[0] ) );
    }

    function phone_check($str)
    {
        $str = preg_replace( '/[^0-9]/','',$str );
        if ( strlen($str) > 11 || strlen($str) < 9 )
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
        $str = preg_replace( '/[^0-9]/','',$str );
        if ( strlen($str) != 10 )
        {
            $this->form_validation->set_message('nip_check', '%s is not a valid nip');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}