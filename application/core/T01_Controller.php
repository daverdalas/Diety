<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 15:46
 */
class T01_Controller extends CI_Controller {

    protected $isLoggedIn;

    function __construct()
    {
        parent::__construct();
        $this->isLoggedIn = isset($this->session->userdata['user']);
    }

    protected function json( $data = array() )
    {
         die( json_encode($data, JSON_PRETTY_PRINT) );
    }

    protected function http404()
    {
        set_status_header(404);
        die("");
    }

    protected function show( $view, $data = array() )
    {
        $dir = $this->isLoggedIn ? "user" : "guest";
        if( is_file( APPPATH."views\\$dir\\$view.php" ) )
            $view = "$dir\\$view.php";
        else
        {
            if( is_file( APPPATH."views\\guest\\$view.php" ) )
                $view = "guest\\$view.php";
            else
            {
                if( is_file( APPPATH."views\\$view.php" ) )
                    $view = "$view.php";
                else
                    $view = "\home.php";
            }
        }

        $data['__session'] = $this->session->all_userdata;
        $data['__user'] = $this->isLoggedIn;
        $this->load->view( $view, $data );
    }

    protected function Debug( $data, $die = false )
    {
        echo '<pre>';
        print_r( $data );
        echo '</pre>';
        if( $die ) exit;
    }
}