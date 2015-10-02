<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 01.10.15
 * Time: 15:25
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class User_panel extends T01_Controller {

    public function index()
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');

        $this->load->model('Ordermodel');
        $plans = $this->Ordermodel->get_plan(
            $this->session->userdata['user']->id,
            array('A')
        );
        foreach( $plans as $plan )
        {
            $now = new DateTime();
            $now->modify( "+1 ".( $plan->weekend ? "day" : "weekday" ) );
            for( $i=0; $i<count($plan->banned); $i++ )
            {
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $plan->banned[$i]->timestamp );
                if( $date == $now )
                    $now->modify( "+1 ".( $plan->weekend ? "day" : "weekday" ) );
                if( $date > $now ) break;
            }
            $plan->next = $now->format('Y-m-d');
            $d = $now->format('w');

            if( $plan->weekend == 1 && ( $d == 0 || $d == 6 ) )
            {
                $plan->from = $plan->time_from_w == null ? $plan->time_from : $plan->time_from_w;
                $plan->to = $plan->time_to_w == null ? $plan->time_to : $plan->time_to_w;
                $plan->addy = $plan->addy_w == null ? $plan->time_to : $plan->addy_w;
            }
            else
            {
                $plan->from = $plan->time_from;
                $plan->to = $plan->time_to;
            }
        }

        $this->show('panels/user/index', array( 'orders' => $plans ));
    }

    public function history()
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');

        $this->load->model('Ordermodel');
        //$this->Debug($this->Ordermodel->get_order( $this->session->userdata['user']->id ),true);
        $this->show(
            'panels/user/history',
            array( 'orders' => $this->Ordermodel->get_order( $this->session->userdata['user']->id ) ),
            true
        );
    }

    public function edit( $id )
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        $this->load->model('Ordermodel');

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
                //$this->Debug($this->input->post(), true);
                $orders = $this->Ordermodel->update(
                    $this->session->userdata['user']->id,
                    $this->input->post()
                );
                redirect('/user_panel/history', 'refresh');
            }
        }

        $orders = $this->Ordermodel->get_plan(
            $this->session->userdata['user']->id,
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
}