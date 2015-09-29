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

        $this->load->model('Dietmodel');
        $this->Debug( $this->Dietmodel->all(), true );
    }
}
