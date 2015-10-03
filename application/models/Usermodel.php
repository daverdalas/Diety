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

    function activate( $uid, $token )
    {
        $this->db
            ->where('id', $uid)
            ->like( 'token', $token )
            ->update('users', array( 'status' => 'X' ) );
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

    function fetch_user( $id )
    {
        $h = $this->db
            ->select('*')
            ->from("users")
            ->where('id',$id )
            ->get()
            ->result();
        return $h == null ? $h : $h[0];
    }

    function update( $uid, $form )
    {
        if( !array_key_exists( 'company', $form ) )
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

        $this->db->update('users', $form);
    }

    function save( $form )
    {
        $form['hash'] = md5( $form['pass1'] );
        $form['token'] = md5( time().$form['hash'] );
        unset( $form['pass1'] );
        unset( $form['pass2'] );
        if( !array_key_exists( 'company', $form ) )
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

        $this->load->library('email');
        $this->email->from( $_SERVER['___MAIL_USER'], 'cooking.pl' );
        $this->email->to( $form['email'] );
        $this->email->subject('Aktywacja konta');
        $this->email->message(
            $this->load->view(
                'email/activation',
                array(
                    'user_id' => $this->db->insert_id(),
                    'token' => $form['token']
                ),
                true
            )
        );
        $this->email->send();
    }

    function get_users()
    {
        $users = $this->db
            ->select('id, name, surname, role, status')
            ->from("users")
            ->get()
            ->result();

        foreach( $users as $user )
        {
            $user->plans = $this->db
                ->select('id, diet')
                ->from("plans")
                ->where("status","A")
                ->get()
                ->result();
        }

        return $users;
    }
}