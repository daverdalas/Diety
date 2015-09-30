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

    public function addy()
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        if( !isset($this->session->userdata['cart']) ) redirect('/order', 'refresh');

        if( count($this->input->post()) > 0 )
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('zgoda1', 'zgoda1', 'required');
            $this->form_validation->set_rules('zgoda2', 'zgoda2', 'required');

            $this->form_validation->set_rules('email', 'email', 'required|max_length[255]|valid_email');
            $this->form_validation->set_rules('name', 'imię', 'required|min_length[6]|max_length[255]');
            $this->form_validation->set_rules('surname', 'nazwisko', 'required|min_length[6]|max_length[255]');
            $this->form_validation->set_rules('phone', 'telefon', 'required|min_length[9]|max_length[255]|callback_phone_check');
            $this->form_validation->set_rules('addy', 'adres dostawy', 'required|min_length[6]');

            if( $this->input->post("cnip") != null )
            {
                $this->form_validation->set_rules('company', 'nazwa firmy', 'required|min_length[6]|max_length[255]');
                $this->form_validation->set_rules('nip', 'nip', 'required|min_length[10]|max_length[255]|callback_nip_check');
                $this->form_validation->set_rules('fvat', 'adres fvat', 'required|min_length[6]');
            }

            if( $this->input->post("cother") != null )
            {
                $this->form_validation->set_rules('addy2', 'adres dostawy', 'required|min_length[6]');
            }

            $this->form_validation->set_rules('from', 'od', 'required|integer|numeric|greater_than[5]|less_than[11]');
            $this->form_validation->set_rules('to', 'do', 'required|integer|numeric|greater_than['.$this->input->post("from").']|less_than[12]');

            if( $this->input->post("cotherh") != null )
            {
                $this->form_validation->set_rules('from1', 'od', 'required|integer|numeric|greater_than[5]|less_than[11]');
                $this->form_validation->set_rules('to1', 'do', 'required|integer|numeric|greater_than['.$this->input->post("from").']|less_than[12]');
            }


            if ($this->form_validation->run() == TRUE ) {

                $c = new stdClass();
                $c->name = $this->input->post( 'name' );
                $c->surname = $this->input->post( 'surname' );
                $c->email = $this->input->post( 'email' );

                $c->phone = $this->input->post( 'phone' );
                $c->phone = preg_replace( '/[^0-9]/','',$c->phone );

                if( strlen($c->phone) > 9 )
                    $c->phone = "+".substr($c->phone, 0, 2).".".substr($c->phone, 2);
                else
                    $c->phone = "+48".substr($c->phone, 2);

                $c->addy = $this->input->post( 'addy' );
                $c->addy_w = $this->input->post("cother") == null ? $this->input->post( 'addy' ) : $this->input->post( 'addy2' );

                $c->from = $this->input->post( 'from' );
                $c->from_w = $this->input->post("cotherh") == null ? $this->input->post( 'from' ) : $this->input->post( 'from1' );

                $c->to = $this->input->post( 'to' );
                $c->to_w = $this->input->post("cotherh") == null ? $this->input->post( 'to' ) : $this->input->post( 'to1' );

                if( $this->input->post("cnip") != null )
                {
                    $c->company = $this->input->post( 'company' );
                    $c->nip = $this->input->post( 'nip' );
                    $c->nip = preg_replace( '/[^0-9]/','',$c->nip );
                    $c->nip = sprintf(
                        '%s-%s-%s-%s',
                        substr($c->nip, 0, 3),
                        substr($c->nip, 3, 3),
                        substr($c->nip, 6, 2),
                        substr($c->nip, 8, 2)
                    );
                    $c->fvat = $this->input->post( 'fvat' );
                }

                if( $this->input->post("comment") != null )
                    $c->comment = $this->input->post( 'comment' );

                $this->Debug( $c, true );
                $cart = $this->session->userdata('cart_addy');
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

        $this->show( 'order_addy', array( 'user' => $this->session->userdata['user'] ) );
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
            $this->form_validation->set_message('nip_check', $str.' is not a valid NIP');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
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
