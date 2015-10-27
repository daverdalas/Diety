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

    function set_payment_id( $order_id, $payment_id )
    {
        $this->db
            ->where('id', $order_id)
            ->update('orders', array( 'payment' => $payment_id ) );
    }

    function update_status( $payment_id, $status )
    {
        $this->db
            ->like('payment', $payment_id)
            ->update('orders', array( 'status' => $status ) );
    }

    function update_plan_status( $id, $status )
    {
        $this->db
            ->where('id', $id)
            ->update('plans', array( 'status' => $status ) );

        $this->db
            ->where( 'plan', $id )
            ->delete( 'calendar' );
    }

    function activate( $payment_id, $status = 'X' )
    {
        $this->db
            ->like('payment', $payment_id)
            ->update('orders', array( 'status' => $status ) );

        $d = $this->db
            ->select('id')
            ->from("orders")
            ->like('payment', $payment_id)
            ->get()
            ->result();

        if( $d == null ) continue;
        $d = $d[0];

        $this->db
            ->where('order', $d->id)
            ->like('status', 'W')
            ->update('plans', array( 'status' => 'A' ) );

        $order = $this->get_order( null, $d->id );

        $this->calendar( $order[0]->data->user );

        $user = $this->db
            ->select('*')
            ->from("users")
            ->where('id', $order[0]->data->user)
            ->get()
            ->result();

        if( $user != null ) $order[0]->user = $user[0];
        return $order[0];
    }

    function make_invoice( $order_id, $user_id )
    {
        $d = $this->db
            ->select('*')
            ->from("invoices")
            ->where( "user", $user_id )
            ->where( "order", $order_id )
            ->get()
            ->result();

        if( $d != null && count($d)>0 ) return $d[0]->id;

        $this->db->insert('invoices',
            array(
                'user' => $user_id,
                'order' => $order_id,
            )
        );
        return $this->db->insert_id();
    }

    function update_invoice( $id, $path )
    {
        $this->db
            ->where('id', $id)
            ->update('invoices', array( 'path' => $path ) );
    }

    function save( $addy, $cart )
    {
        $this->db->insert('orders',
            array(
                'user' => $addy->user,
                'company' => property_exists( $addy,'company') ? $addy->company : null,
                'nip' => property_exists( $addy,'nip') ? $addy->nip : null,
                'fvat' => property_exists( $addy,'fvat') ? $addy->fvat : null,
                'comment' => property_exists( $addy,'comment') ? $addy->comment : "",
            )
        );
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
                'days_total' => $days,
                'quantity' => $order->number,
                'price' => $price,
                'user' => $addy->user,
                'name' => $addy->name,
                'surname' => $addy->surname,
                'email' => $addy->email,
                'phone' => $addy->phone,
                'addy' => $addy->addy,
                'addy_w' => property_exists( $addy,'addy_w') ? $addy->addy_w : null,
                'time_from' => $addy->from,
                'time_from_w' => property_exists( $addy,'from_w') ? $addy->from_w : null,
                'time_to' => $addy->to,
                'time_to_w' => property_exists( $addy,'to_w') ? $addy->to_w : null,
            );

            $this->db->insert('plans', $i);
        }
        return $order_id;
    }

    function get_order( $user_id = null, $order_id = null, $status = null, $carts=true )
    {
        $query = $this->db
            ->select('*')
            ->from("orders");

        if( $user_id != null ) $query = $query->where( "user", $user_id );
        if( $order_id != null ) $query = $query->where( "id", $order_id );
        $orders =  $query->get()->result();

        if( $orders == null ) return array();

        if( $carts != true ) return $orders;

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

            $cost = 0;
            foreach($carts as $cart ) $cost += $cart->price*$cart->quantity;
            $order->price = $cost;

            $invoice = $this->db
                ->select('id')
                ->from("invoices")
                ->where( "order", $order->id )
                ->where( "path IS NOT NULL", null )
                ->get()
                ->result();

            if( $invoice != null && count($invoice)>0 ) $invoice = $invoice[0]->id;
            else $invoice = null;
            $order->invoice = $invoice;

            $r = new stdClass();
            $r->data = $order;
            $r->cart = $carts;
            array_unshift( $ret, $r );
        }

        return count( $ret ) ? $ret : array();
    }

    function get_invoice( $id )
    {
        $r = $this->db
            ->select('*')
            ->from("invoices")
            ->where('id', $id )
            ->where('path IS NOT NULL', null )
            ->get()
            ->result();

        return $r != null && count($r) ? $r[0] : null;
    }

    function get_invoice4order( $id )
    {
        $r = $this->db
            ->select('*')
            ->from("invoices")
            ->where('order', $id )
            ->where('path IS NOT NULL', null )
            ->get()
            ->result();

        return $r != null && count($r) ? $r[0] : null;
    }

    function get_plan( $user_id = null, $status = null, $plan_id = null )
    {
        $query = $this->db
            ->select('*')
            ->from("plans");

        if( $user_id != null ) $query = $query->where( "user", $user_id );
        if( $status != null ) $query = $query->where_in( "status", $status );
        if( $plan_id != null ) $query = $query->where( "id", $plan_id );

        $carts =  $query->get()->result();

        foreach( $carts as $cart )
        {
            $cart->banned = $this->db
                ->select('timestamp')
                ->from("banned")
                ->where( "order", $cart->id )
                ->order_by("timestamp", "asc")
                ->get()
                ->result();
        }
        return count( $carts ) ? $carts : array();
    }

    function update( $data )
    {
        $data['phone'] = preg_replace( '/[^0-9]/','',$data['phone'] );

        if( strlen($data['phone']) > 9 )
            $data['phone'] = "+".substr($data['phone'], 0, 2).".".substr($data['phone'], 2);
        else
            $data['phone'] = "+48.".$data['phone'];

        $d = array(
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'addy' => $data['addy'],
            'time_from' => $data['from'],
            'time_to' => $data['to'],
            'addy_w' => $data['addy2'],
            'time_from_w' => $data['from1'],
            'time_to_w' => $data['to1'],
            'weekend' => array_key_exists('weekends',$data) ? 1 : 0
        );

        $this->db
            ->where('id', $data['id'] )
            ->where_in('status', array( 'W', 'A' ) )
            ->update('plans', $d );

        if(
            count(
                $this->db
                    ->select('id')
                    ->from("plans")
                    ->where('id', $data['id'] )
                    ->where_in('status', array( 'W', 'A' ) )
                    ->get()
                    ->result()
            ) ==0
        ) return;


        $this->db->delete('banned', array('order' => $data['id']));

        $now = new DateTime();
        $rows = array();
        if( !array_key_exists('banned', $data) ) $data['banned'] = array();
        foreach( $data['banned'] as $date )
        {
            $date = DateTime::createFromFormat('Y-m-d', $date );
            if( $date < $now ) continue;
            array_push(
                $rows,
                array(
                    'timestamp' => $date->format('Y-m-d').' 00:00:00',
                    'order' => $data['id']
                )
            );
        }

        if( count($rows) ) $this->db->insert_batch('banned', $rows);
    }

    function checkPlanOwner( $order_id, $uid )
    {
        return count(
                    $this->db
                    ->select('*')
                    ->from("plans")
                    ->where( "user", $uid )
                    ->get()
                    ->result()
                ) > 0;
    }

    function checkOrderOwner( $order_id, $uid )
    {
        return count(
            $this->db
                ->select('*')
                ->from("orders")
                ->where( "user", $uid )
                ->get()
                ->result()
        ) > 0;
    }

    function shedule( $day )
    {
        return $this->db
            ->select(
                "date(calendar.day) as 'date', ".
                "users.name, ".
                "users.surname, ".
                "plans.diet, ".
                "plans.phone, ".
                "calendar.from, ".
                "calendar.to, ".
                "calendar.addy, ".
                "plans.quantity"
            )
            ->from("calendar")
            ->join('users', 'users.id = calendar.user', 'left')
            ->join('plans', 'plans.id = calendar.plan', 'left')
            ->where( 'date(day)', $day )
            ->order_by("users.surname, users.name, plans.diet", "asc")
            ->get()->result();
    }

    private $dt = 0;

    function calendar( $uid = 0 )
    {
        $now = new DateTime();
        $now->modify( $this->dt." day" );
        if( $uid == 0 ) echo $now->format('Y-m-d');
        $hour = $now->format('G');


        $q = $this->db
                ->select(
                    "plans.*,".
                    "( plans.days_total - sum( date(calendar.day) < '".$now->format('Y-m-d')."' AND `calendar`.`day` is not null ) ) as 'days_future',"
                    )
                ->from("plans")
                ->join('calendar', 'plans.id = calendar.plan', 'left')
                ->where( 'plans.status', 'A' );

        if( $uid ) $q = $q->where( "plans.user", $uid );
        $q = $q->group_by("plans.id");

        $plans = $q->get()->result();

        /*
        echo '<pre>';
        print_r( $plans );
        exit;
        */
        $now->modify( "+".( $hour > 14 ? 2 : 1 )." day" );
        $deadline = $now->format('Y-m-d');

        $q = $this->db
            ->where( 'date(day) >=', $deadline );

        if( $uid ) $q = $q->where( "user", $uid );
        $q->delete( 'calendar' );

        $callendars = array();
        foreach( $plans as $plan ) {
            $banned = $this->db
                ->select('timestamp')
                ->from("banned")
                ->where("order", $plan->id)
                ->order_by("timestamp", "asc")
                ->get()
                ->result();

            $now = new DateTime();
            $now->modify( $this->dt." day" );
            $now->modify( "+".( $hour > 14 ? 2 : 1 )." day" );

            $from = DateTime::createFromFormat('Y-m-d H:i:s', $plan->from );
            $now = $from > $now ? $from : $now;

            $left = $plan->days_future;
            $now->modify("-1 day");
            while ($left > 0) {
                $now->modify("+1 " . ($plan->weekend ? "day" : "weekday"));
                for ($i = 0; $i < count($banned); $i++) {
                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $banned[$i]->timestamp);
                    if ($date == $now)
                        $now->modify("+1 " . ($plan->weekend ? "day" : "weekday"));
                    if ($date > $now) break;
                }

                $w = $now->format('w');

                $d = array(
                    'plan' => $plan->id,
                    'user' => $plan->user,
                    'day' => $now->format('Y-m-d').' 00:00:00',
                    'weekend' => $w == 0 || $w == 6,
                );

                if ($plan->weekend == 1 && ($w == 0 || $w == 6)) {
                    $d['from'] = $plan->time_from_w == null ? $plan->time_from : $plan->time_from_w;
                    $d['to'] = $plan->time_to_w == null ? $plan->time_to : $plan->time_to_w;
                    $d['addy'] = $plan->addy_w == null ? $plan->time_to : $plan->addy_w;
                } else {
                    $d['from'] = $plan->time_from;
                    $d['to'] = $plan->time_to;
                    $d['addy'] = $plan->addy;
                }

                array_push($callendars, $d);
                $left--;
            }

            $this->db
                ->where('id', $plan->id)
                ->update(
                    'plans',
                    array(
                        'days_left' => $plan->days_future,
                        'status' => $plan->days_future > 0 ? 'A' : 'X',
                        'from' => $plan->from,
                    )
                );
        }

        if( count($callendars) > 0 ) $this->db->insert_batch( 'calendar', $callendars );
    }

    function get_callendar( $uid )
    {
        $now = new DateTime();
        $now->modify( $this->dt." day" );
        $now = $now->format('Y-m-d').' 00:00:00';

        $c = $this->db
            ->select('*')
            ->from("calendar")
            ->where("user", $uid)
            ->where( 'date(calendar.day) >=', $now )
            ->order_by("day", "asc")
            ->get()
            ->result();

        $calendar = array();
        foreach( $c as $entry )
        {
            if( !array_key_exists( $entry->plan, $calendar) )
                $calendar[ $entry->plan ] = array();

            $entry->day = DateTime::createFromFormat('Y-m-d H:i:s', $entry->day )->format('Y-m-d');
            array_push( $calendar[ $entry->plan ], $entry );
        }

        return $calendar;
    }
}