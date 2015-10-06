<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 16:30
 */

defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

class Migration_Add_orders extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user' => array('type' => 'BIGINT','unsigned' => TRUE,),
            'timestamp' => array('type' => 'TIMESTAMP',),
            'payment' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'comment' => array('type' => 'TEXT', 'null' => TRUE,),
            'company' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'nip' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'fvat' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'VARCHAR', 'constraint' => '10', 'null' => TRUE, 'default' => 'NEW'),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('orders');

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user' => array('type' => 'BIGINT','unsigned' => TRUE,),
            'order' => array('type' => 'BIGINT','unsigned' => TRUE,),
            'diet' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'from' => array('type' => 'TIMESTAMP',),
            'weekend' => array('type' => 'INT', 'constraint' => '1',),
            'status' => array('type' => 'VARCHAR', 'constraint' => '1','default' => 'W'),
            'days_left' => array('type' => 'BIGINT',),
            'days_total' => array('type' => 'BIGINT',),
            'quantity' => array('type' => 'BIGINT',),
            'price' => array('type' => 'BIGINT',),

            'name' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'surname' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'email' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'addy' => array('type' => 'TEXT',),
            'addy_w' => array('type' => 'TEXT', 'null' => TRUE,),
            'time_from' => array('type' => 'INT',),
            'time_from_w' => array('type' => 'INT', 'null' => TRUE,),
            'time_to' => array('type' => 'INT',),
            'time_to_w' => array('type' => 'INT', 'null' => TRUE,),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('plans');
  }

    public function down()
    {
        $this->dbforge->drop_table('orders');
        $this->dbforge->drop_table('plans');
    }
}