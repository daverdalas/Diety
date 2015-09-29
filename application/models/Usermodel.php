<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 28.09.15
 * Time: 16:13
 */

class Usermodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_hash( $email )
    {
        return $this->db
                    ->select('hash')
                    ->from("users")
                    ->like('email',trim($email) )
                    ->get()
                    ->result();
    }
}