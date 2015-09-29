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
        $h = $this->db
            ->select('hash')
            ->from("users")
            ->like('email',trim($email) )
            ->get()
            ->result();
        return $h == null ? $h : $h[0]->hash;
    }

    function get_user( $d )
    {
        $h = $this->db
            ->select('*')
            ->from("users")
            ->like('email',trim($d['email']) )
            ->like('hash',md5(trim($d['pass'])) )
            ->get()
            ->result();
        return $h == null ? $h : $h[0];
    }

    function save( $form )
    {
        $form['hash'] = md5( $form['pass1'] );
        unset( $form['pass1'] );
        unset( $form['pass2'] );
        if( $form['company'] == null )
        {
            unset( $form['nip'] );
            unset( $form['fvat'] );
        }
        else{
            $form['nip'] = preg_replace( '/[^0-9]/','',$form['nip'] );
            $form['nip'] = sprintf(
                                '%s-%s-%s-%s',
                                substr($form['nip'], 0, 3),
                                substr($form['nip'], 3, 3),
                                substr($form['nip'], 6, 2),
                                substr($form['nip'], 8, 2)
                            );
        }

        $form['phone'] = preg_replace( '/[^0-9]/','',$form['phone'] );

        if( strlen($form['phone']) > 9 )
            $form['phone'] = "+".substr($form['phone'], 0, 2).".".substr($form['phone'], 2);
        else
            $form['phone'] = "+48".substr($form['phone'], 2);

        unset( $form['company'] );

        $this->db->insert('users', $form);
    }
}