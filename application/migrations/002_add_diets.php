<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 16:30
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_diets extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'calories' => array('type' => 'BIGINT',),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('diets');

        $this->dbforge->add_field(array(
            'diet' => array('type' => 'BIGINT',),
            'label' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'days' => array('type' => 'BIGINT',),
            'price' => array('type' => 'BIGINT',),
        ));

        $this->dbforge->create_table('diet_pricelist');

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
                        'label' => $n,
                        'days' => $p,
                        'price' => $p*2000 - floor($p/7)*2500
                    );
                    $this->db->insert('diet_pricelist', $d);
                }
            }
        }
    }

    public function down()
    {
        $this->dbforge->drop_table('diets');
        $this->dbforge->drop_table('diet_pricelist');
    }
}