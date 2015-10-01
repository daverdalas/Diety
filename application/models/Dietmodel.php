<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 16:52
 */

class Dietmodel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function check( $id )
    {
        return $this->db
            ->select('*')
            ->from("diet_pricelist")
            ->where( "id", $id )
            ->get()
            ->result();
    }

    function cart( $cart )
    {
        $r = array();
        $p = 0;
        foreach( $cart as $id => $order )
        {
            $d = $this->db
                ->select('*')
                ->from("diet_pricelist")
                ->where( "id", $order->id )
                ->get()
                ->result();

            if( $d == null ) continue;
            $d = $d[0];

            $price = $d->price/100;
            $days = $order->weekend ? $d->days : 0;
            $weekdays = $order->weekend ? 0 : $d->days;

            $d = $this->db
                ->select('*')
                ->from("diets")
                ->where( "id", $d->diet )
                ->get()
                ->result();

            if( $d == null ) continue;
            $d = $d[0];

            $name = $d->name." ".$d->calories." KCAL";

            $date = DateTime::createFromFormat('Y-m-d', $order->from );
            $now = new DateTime();
            $from = max( $date, $now );

            $date = DateTime::createFromFormat('Y-m-d', $order->from );
            $now = new DateTime();
            $to = max( $date, $now );
            $to->modify( "+$days day");
            $to->modify( "+$weekdays weekday");

            $i = new stdClass();
            $i->id = $id;
            $i->label = $name;
            $i->quantity = $order->number;
            $i->begin = $from->format('Y-m-d');
            $i->end = $to->format('Y-m-d');
            $p += $price*$order->number;
            $i->cost = $order->number." x ".sprintf("%01.2f", $price)." PLN";
            $i->unitprice = sprintf("%01.2f", $price);

            array_push( $r, $i );
        }

        return array( 'cost' => sprintf("%01.2f", $p), 'cart' => $r );
    }

    function all()
    {
        $diets = $this->db
            ->select('*')
            ->from("diets")
            ->get()
            ->result();

        $r = array(
            'diets' => array(),
            'prices' => array()
        );

        foreach( $diets as $diet )
        {
            if( !array_key_exists( $diet->name, $r['diets'] ) )
                $r['diets'][ $diet->name ] = array();

            array_push($r['diets'][ $diet->name ], $diet );
        }

        $diets = $this->db
            ->select('*')
            ->from("diet_pricelist")
            ->get()
            ->result();

        foreach( $diets as $diet )
        {
            if( !array_key_exists( $diet->diet, $r['prices'] ) )
                $r['prices'][ $diet->diet ] = array();

            array_push($r['prices'][ $diet->diet ], $diet );
        }
        return $r;
    }
}