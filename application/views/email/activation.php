<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 01.10.15
 * Time: 13:46
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
click to activate: <?=anchor("/register/activate/$user_id/$token");?>