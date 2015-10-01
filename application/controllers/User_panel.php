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
        $this->show('panels/user/index');
    }
}