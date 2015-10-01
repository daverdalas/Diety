<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 16:52
 */

class Ordermodel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function save( $order, $cart )
    {
        $this->db->insert('orders', (array)$order);
        $order_id = $this->db->insert_id();

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
            $days = $d->days;
            $price = $d->price;

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

            $i = array(
                'order' => $order_id,
                'diet' => $name,
                'from' => $from->format('Y-m-d').' 00:00:00',
                'weekend' => $order->weekend,
                'days_left' => $days,
                'quantity' => $order->number,
                'price' => $price,
            );

            $this->db->insert('plans', $i);
        }
        return $order_id;
    }

    function get_order( $user_id, $order_id = null, $status = null )
    {
        $query = $this->db
            ->select('*')
            ->from("orders")
            ->where( "user", $user_id );

        if( $order_id != null ) $query = $query->where( "id", $order_id );
        $orders =  $query->get()->result();

        if( $orders == null ) return null;

        $ret = array();
        foreach( $orders as $order )
        {
            $query = $this->db
                ->select('*')
                ->from("plans")
                ->where( "order", $order->id );

            if( $status != null ) $query = $query->like( "status", $status );

            $carts =  $query->get()->result();
            if( count($carts) == 0 ) continue;

            $r = new stdClass();
            $r->data = $order;
            $r->cart = $carts;
            array_push( $ret, $r );
        }

        return count( $ret ) ? $ret : null;
    }
}