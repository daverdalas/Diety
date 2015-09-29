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

    function all()
    {
        $diets = $this->db
            ->select('*')
            ->from("diets")
            ->join('diet_pricelist', 'diet_pricelist.diet = diets.id')
            ->get()
            ->result();

        $r = array();

        foreach( $diets as $diet )
        {
            if( !array_key_exists( $diet->name, $r ) )
                $r[ $diet->name ] = array();

            if( !array_key_exists( $diet->calories, $r[ $diet->name ] ) )
                $r[ $diet->name ][$diet->calories] = array();

            $diet->price /= 100;
            $r[ $diet->name ][$diet->calories][$diet->days] = $diet;
        }
        return $r;
    }
}