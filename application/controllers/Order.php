<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 16:51
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends T01_Controller {

    public function index()
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');

        if( count($this->input->post()) > 0 )
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('number', 'number', 'required|integer|numeric|greater_than[0]');
            $this->form_validation->set_rules('date', 'date', 'required|callback_date_check');
            $this->form_validation->set_rules('id', 'id', 'callback_id_check');

            if ($this->form_validation->run() == TRUE ) {
                $cart = $this->session->userdata('cart');
                if( $cart == null ) $cart = array();

                $c = new stdClass();
                $c->id = $this->input->post('id');
                $c->from = $this->input->post('date');
                $c->weekend = $this->input->post('weekends') != null;
                $c->number = $this->input->post('number');

                array_push( $cart, $c );
                $this->session->set_userdata('cart', $cart );

                redirect('/order/cart', 'refresh');
                return;
            }
        }

        $this->load->model('Dietmodel');
        $this->show('order', $this->Dietmodel->all());
    }

    public function pay()
    {
        $cart = $this->session->userdata('cart');
        $this->Debug($cart,true);
    }

    public function cart()
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        $cart = $this->session->userdata('cart');
        $this->load->model('Dietmodel');
        $this->show( 'cart' );
    }

    public function get_cart()
    {
        if( !$this->isLoggedIn ) $this->http404();;
        $cart = $this->session->userdata('cart');
        $this->load->model('Dietmodel');
        $this->show( 'cart_table', $this->Dietmodel->cart( $cart ) );
    }

    public function modify_cart()
    {
        if( !$this->isLoggedIn ) $this->http404();;
        if( count($this->input->post()) > 0 ) {
            $p = $this->input->post();
            $cart = $this->session->userdata('cart');
            foreach( $p as $i => $n )
                if( $n == 0 )
                    unset($cart[$i]);
                else
                    $cart[$i]->number = $n;
            $this->session->set_userdata('cart', $cart);
        }
        $this->get_cart();
    }

    public function remove_from_cart( $id )
    {
        if( !$this->isLoggedIn ) $this->http404();;
        $cart = $this->session->userdata('cart');
        unset( $cart[$id] );
        $this->session->set_userdata('cart', $cart );
        $this->get_cart();
    }

    function date_check($str)
    {
        $date = DateTime::createFromFormat('Y-m-d', $str );
        $now = new DateTime();

        if ( $date < $now )
        {
            $this->form_validation->set_message('date_check', 'data '.$str.' wskazuje na przeszłość' );
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function id_check($id)
    {
        $this->load->model('Dietmodel');

        if ( $this->Dietmodel->check( $id ) == null )
        {
            $this->form_validation->set_message('id_check', 'błedna konfiguracja diety' );
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
