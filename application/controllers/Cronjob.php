<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 16:51
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'third_party/openpayu/lib/openpayu.php');

class Cronjob extends T01_Controller {

    function index()
    {
        set_time_limit(0);
        $this->load->model('Ordermodel');
        $callendar = $this->Ordermodel->calendar( );
        $this->Debug( $callendar, true );
    }

}
