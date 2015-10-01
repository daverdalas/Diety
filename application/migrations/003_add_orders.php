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
            'name' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'surname' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'email' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'addy' => array('type' => 'TEXT',),
            'addy_w' => array('type' => 'TEXT',),
            'from' => array('type' => 'INT',),
            'from_w' => array('type' => 'INT',),
            'to' => array('type' => 'INT',),
            'to_w' => array('type' => 'INT',),
            'company' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'nip' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'fvat' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'comment' => array('type' => 'TEXT',),
            'payment' => array('type' => 'VARCHAR', 'constraint' => '255',),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('orders');

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'order' => array('type' => 'BIGINT','unsigned' => TRUE,),
            'diet' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'from' => array('type' => 'TIMESTAMP',),
            'weekend' => array('type' => 'INT', 'constraint' => '1',),
            'status' => array('type' => 'VARCHAR', 'constraint' => '1','default' => 'W'),
            'days_left' => array('type' => 'BIGINT',),
            'quantity' => array('type' => 'BIGINT',),
            'price' => array('type' => 'BIGINT',),
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