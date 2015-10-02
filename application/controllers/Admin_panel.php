<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 01.10.15
 * Time: 15:25
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_panel extends T01_Controller {

    public function index()
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        if( !$this->isAdmin ) redirect('/', 'refresh');
        $this->show('panels/admin/index');
    }

    public function users()
    {
        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        if( !$this->isAdmin ) redirect('/', 'refresh');

        $this->load->model('Usermodel');
        $users = $this->Usermodel->get_users(
        );
        $this->show('panels/admin/users', array( 'users' => $users ) );
    }
}