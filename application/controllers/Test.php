<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 01.10.15
 * Time: 15:25
 */

defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

class Test extends T01_Controller {

    public function index()
    {
        die('0');

        if( !$this->isLoggedIn ) redirect('/login', 'refresh');
        if( !$this->isAdmin ) redirect('/', 'refresh');

        $this->load->model('Ordermodel');
        $this->db = $this->Ordermodel->db;

        $this->make_users();
        $this->put_orders();
        $this->put_diets();
    }

    private function put_diets()
    {
        $diets = array(
            "STANDARD",
            "SPORT",
            "WEGE",
            "WEGE+FISH",
            "BEZGLUTEN"
        );

        $periods = array(
            "TESTOWA" => 1,
            "1 DZIEN" => 1,
            "1 TYDZIEN" => 7,
            "2 TYGODNIE" => 14,
            "3 TYGODNIE" => 21,
            "4 TYGODNIE" => 28,
        );

        foreach( $diets as $diet )
        {
            for( $c=500; $c<3000; $c+=500 ) {
                $d = array(
                    'name' => $diet,
                    'calories' => $c
                );

                $this->db->insert('diets', $d);

                $id = $this->db->insert_id();

                foreach( $periods as $n => $p )
                {
                    $d = array(
                        'diet' => $id,
                        'name' => $n,
                        'days' => $p,
                        'price' => $p*$c + 10*$id - floor($p/7)*2500
                    );
                    $this->db->insert('diet_pricelist', $d);
                }
            }
        }
    }

    private function put_orders()
    {
        $users = $this->db
            ->select('*')
            ->from("users")
            ->where("token", "123")
            ->get()
            ->result();

        $diets = $this->db
            ->select('*')
            ->from("diets")
            ->get()
            ->result();

        $diet = $diets[ rand(0,count($diets)-1) ];
        $days = array( 1,7,14,21,28 );

        foreach( $users as $user )
        {
            $this->db->insert(
                'orders',
                array(
                    'user' => $user->id,
                    'payment' => '123.'.$user->id,
                )
            );
            $order_id = $this->db->insert_id();

            for( $x=0; $x<rand(2,7); $x++ ) {
                $now = new DateTime();
                $now->modify((20 - rand(0, 10)) . " day");

                $diet = $diets[rand(0, count($diets) - 1)];
                $this->db->insert(
                    'plans',
                    array(
                        'order' => $order_id,
                        'diet' => $diet->name,
                        'from' => $now->format('Y-m-d') . ' 00:00:00',
                        'weekend' => rand(0, 1),
                        'status' => 'A',
                        'days_left' => 0,
                        'days_total' => $days[rand(0, count($days) - 1)],
                        'quantity' => rand(1, 5),
                        'price' => rand(200, 5000),
                        'name' => $user->name,
                        'surname' => $user->surname,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'addy' => $user->addy,
                        'time_from' => '6',
                        'time_to' => '10',
                        'user' => $user->id
                    )
                );
            }
        }

        $this->load->model('Ordermodel');
        $this->Ordermodel->calendar();;
    }

    private function make_users()
    {
        $names = file( APPPATH."..\\imiona.txt" );
        $surnames = file( APPPATH."..\\nazwiska.txt" );
        $adresy = file( APPPATH."..\\adresy.txt" );

        $c = min( count($names), count($surnames), count($adresy) );
        $users = array();
        for( $i=0; $i<$c; $i++ )
        {
            array_push(
                $users,
                array(
                    'email' => "slawek+$i@t01.pl",
                    'hash' => md5( "123456" ),
                    'name' => trim($names[$i]),
                    'surname' => trim($surnames[$i]),
                    'phone' => '+48.22'.rand(7000000,7999999),
                    'addy' => trim($adresy[$i]),
                    'token' => '123',
                    'role' => 'U',
                    'status' => 'X'
                )
            );
        }

        $this->db->insert_batch( 'users', $users );
    }
}