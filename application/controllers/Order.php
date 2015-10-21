<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 16:51
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'third_party/openpayu/lib/openpayu.php');

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
            $this->form_validation->set_rules('name', 'imię', 'required|min_length[2]|max_length[255]');
            $this->form_validation->set_rules('surname', 'nazwisko', 'required|min_length[2]|max_length[255]');
            $this->form_validation->set_rules('phone', 'telefon', 'required|min_length[9]|max_length[255]|callback_phone_check');
            $this->form_validation->set_rules('addy', 'adres dostawy', 'required|min_length[3]');

            if( $this->input->post("cnip") != null )
            {
                $this->form_validation->set_rules('company', 'nazwa firmy', 'required|min_length[2]|max_length[255]');
                $this->form_validation->set_rules('nip', 'nip', 'required|min_length[10]|max_length[255]|callback_nip_check');
                $this->form_validation->set_rules('fvat', 'adres fvat', 'required|min_length[3]');
            }

            if( $this->input->post("cother") != null )
            {
                $this->form_validation->set_rules('addy2', 'adres dostawy', 'required|min_length[3]');
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
                    $c->phone = "+48.".$c->phone;

                $c->addy = $this->input->post( 'addy' );
                if( $this->input->post("cother") != null )
                    $c->addy_w = $this->input->post("cother") == null ? $this->input->post( 'addy' ) : $this->input->post( 'addy2' );

                $c->from = $this->input->post( 'from' );
                $c->to = $this->input->post( 'to' );

                if( $this->input->post("cotherh") != null )
                {
                    $c->from_w = $this->input->post("cotherh") == null ? $this->input->post( 'from' ) : $this->input->post( 'from1' );
                    $c->to_w = $this->input->post("cotherh") == null ? $this->input->post( 'to' ) : $this->input->post( 'to1' );
                }


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

                $c->user = $this->session->userdata['user']->id;
                $this->load->model('Ordermodel');
                $order_id = $this->Ordermodel->save( $c, $this->session->userdata('cart') );

                $this->load->model('Dietmodel');
                $cart = $this->session->userdata('cart');
                $this->load->library('email');
                $this->email->from( $_SERVER['___MAIL_USER'], 'cooking.pl' );
                $this->email->to( $c->email );
                $this->email->subject('Twoje zakupy');
                $this->email->message(
                    $this->load->view(
                        'email/order',
                        array(
                            'order_id' => $order_id,
                            'cart' => $this->Dietmodel->cart( $cart ),
                            'data' => $c
                        ),
                        true
                    )
                );
                $this->email->send();

                $this->session->unset_userdata('cart');
                $this->process( $order_id );
            }
        }

        $this->show( 'order_addy', array( 'user' => $this->session->userdata['user'] ) );
    }

    function notify() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->model('Ordermodel');
            $this->config->load('payu', true);
            OpenPayU_Configuration::setEnvironment('secure');
            OpenPayU_Configuration::setMerchantPosId( $this->config->item('PosId', 'payu') );
            OpenPayU_Configuration::setSignatureKey( $this->config->item('SignatureKey', 'payu') );

            $body = file_get_contents('php://input');
            $data = trim($body);
            try {
                if (!empty($data)) {
                    $result = OpenPayU_Order::consumeNotification($data);
                }
                if ($result->getResponse()->order->orderId) {
                    /* Check if OrderId exists in Merchant Service, update Order data by OrderRetrieveRequest */
                    $payment = $result->getResponse()->order->orderId;
                    $order = OpenPayU_Order::retrieve($payment);

                    if($order->getStatus() == 'SUCCESS'){
                        $orders = $order->getResponse()->orders;

                        $now = new DateTime();
                        $y = $now->format("Y");
                        $m = $now->format("m");

                        if( !is_dir( BASEPATH."../invoices" )) mkdir( BASEPATH."../invoices" );
                        if( !is_dir( BASEPATH."../invoices/$y" )) mkdir( BASEPATH."../invoices/$y" );
                        if( !is_dir( BASEPATH."../invoices/$y/$m" )) mkdir( BASEPATH."../invoices/$y/$m" );
                        $dir = BASEPATH."../invoices/$y/$m";

                        foreach( $orders as $order )
                        {
                            $order = $this->Ordermodel->activate( $order->orderId, $order->status );
                            $invoice = $this->Ordermodel->make_invoice($order->data->id, $order->user->id);
                            $order->data->invoice = $invoice;
                            $order->data->date = $now->format("Y-m-d");
                            if (!is_file("$dir/$invoice.pdf")) {
                                $msg = $this->load->view('pdf/invoice', array('order' => $order), true);
                                require_once(BASEPATH . "../html2pdf/html2pdf.class.php");
                                $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
                                $html2pdf->setDefaultFont("dejavusans");
                                $html2pdf->pdf->SetDisplayMode('fullpage');
                                $html2pdf->WriteHTML($msg);
                                $html2pdf->Output( "$dir/$invoice.pdf", 'F' );
                                $this->Ordermodel->update_invoice( $invoice, "/invoices/$y/$m/$invoice.pdf" );
                            }
                        }

                        header("HTTP/1.1 200 OK");
                    }
                }
            } catch (OpenPayU_Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    function invoice( $id )
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');

        $uid = $this->session->userdata['user']->id;

        $this->load->model('Ordermodel');
        $invoice = $this->Ordermodel->get_invoice( $id );

        if( !$this->isAdmin )
        {
            if( $invoice->user != $uid )
                redirect('/user_panel', 'refresh');
        }
        $this->load->helper('download');
        force_download( $invoice->id.".pdf", file_get_contents ( BASEPATH."..".$invoice->path) );
    }

    /*
    function test( $pid = 'NXFS7NCJFQ151002GUEST000P01') {
        $this->load->model('Ordermodel');
        $this->config->load('payu', true);
        OpenPayU_Configuration::setEnvironment('secure');
        OpenPayU_Configuration::setMerchantPosId($this->config->item('PosId', 'payu'));
        OpenPayU_Configuration::setSignatureKey($this->config->item('SignatureKey', 'payu'));

        $order = OpenPayU_Order::retrieve( $pid );



        if ($order->getStatus() == 'SUCCESS') {
            $orders = $order->getResponse()->orders;

            $now = new DateTime();
            $y = $now->format("Y");
            $m = $now->format("m");

            if( !is_dir( BASEPATH."../invoices" )) mkdir( BASEPATH."../invoices" );
            if( !is_dir( BASEPATH."../invoices/$y" )) mkdir( BASEPATH."../invoices/$y" );
            if( !is_dir( BASEPATH."../invoices/$y/$m" )) mkdir( BASEPATH."../invoices/$y/$m" );
            $dir = BASEPATH."../invoices/$y/$m";

            foreach ($orders as $order) {
                if ($order->status == 'CANCELED') {
                    $order = $this->Ordermodel->activate($order->orderId);
                    $invoice = $this->Ordermodel->make_invoice($order->data->id, $order->user->id);
                    $order->data->invoice = $invoice;
                    $order->data->date = $now->format("Y-m-d");
                    if (!is_file("$dir/$invoice.pdf")) {
                        $msg = $this->load->view('invoice', array('order' => $order), true);
                        require_once(BASEPATH . "../html2pdf/html2pdf.class.php");
                        $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
                        $html2pdf->setDefaultFont("dejavusans");
                        $html2pdf->pdf->SetDisplayMode('fullpage');
                        $html2pdf->WriteHTML($msg);
                        $html2pdf->Output( "$dir/$invoice.pdf", 'F' );
                        $this->Ordermodel->update_invoice( $invoice, "/invoices/$y/$m/$invoice.pdf" );
                    }
                }
            }
        }
    }
    */

    function process($order_id)
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');

        $this->load->model('Ordermodel');
        $_order = $this->Ordermodel->get_order(
            $this->session->userdata['user']->id,
            $order_id,
            'W'
        );

        if( $_order == null ) $this->http404();
        $_order = $_order[0];

        $this->config->load('payu', true);
        OpenPayU_Configuration::setEnvironment('secure');
        OpenPayU_Configuration::setMerchantPosId( $this->config->item('PosId', 'payu') );
        OpenPayU_Configuration::setSignatureKey( $this->config->item('SignatureKey', 'payu') );

        $order = array();
        $order['notifyUrl'] = base_url().'index.php/order/notify';
        //$order['notifyUrl'] = "http://t01.pl/payu/index.php";
        $order['continueUrl'] = base_url().'index.php/user_panel/history';
        $order['customerIp'] = $this->input->ip_address();
        $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
        $order['description'] = $this->config->item('title', 'payu');
        $order['currencyCode'] = 'PLN';
        //$order['extOrderId'] = "think01-".time().'-'.$order_id;
        $order['products'] = array();

        $cost = 0;
        if( count( $_order->cart ) == 0 ) return false;
        foreach( $_order->cart as $v ) {
            array_push(
                $order['products'],
                array(
                    'name' => $v->diet,
                    'unitPrice' => $v->price,
                    'quantity' => $v->quantity,
                )
            );
            $cost += $v->price*$v->quantity;
        }
        $order['totalAmount'] = $cost;

        $order['buyer']['email'] = $v->email;
        $order['buyer']['phone'] = preg_replace( '/[^0-9\+]/','',$v->phone );
        $order['buyer']['firstName'] = $v->name;
        $order['buyer']['lastName'] = $v->surname;

        try {        //echo '<pre>'; print_r($order); die('');
            $response = OpenPayU_Order::create($order);
            $status_desc = OpenPayU_Util::statusDesc($response->getStatus());
            if($response->getStatus() == 'SUCCESS') {
                $this->Ordermodel->set_payment_id(
                    $order_id,
                    $response->getResponse()->orderId
                );
                redirect($response->getResponse()->redirectUri, 'refresh');
            }
            else
                $this->show( "alert", array( 'msg' => '<pre>'.print_r($order,true).'</pre><br>'.$response->getStatus().': '.$status_desc) );
            return;
        }catch (OpenPayU_Exception $e){
            $this->show("alert", array( 'msg' => '<pre>'.print_r($order,true).'</pre><br>'.(string)$e ) );
        }
    }

    function delete( $id )
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        if( !$this->isAdmin ) redirect('/', 'refresh');

        $this->load->model('Ordermodel');
        $this->Ordermodel->update_plan_status( $id, 'D' );

        redirect('/admin_panel', 'refresh');
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
            $this->form_validation->set_message('date_check', 'form_validation_t01_date' );
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
            $this->form_validation->set_message('id_check', 'form_validation_t01_diet' );
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}
