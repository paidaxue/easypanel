<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Build_structure extends CI_Migration {

  public function up() {
    $this->load->dbforge();
    //creating database...
    //$this->dbforge->create_database('dev.easypanel');

    //creating admin users...

    $this->dbforge->add_field(array(
        'id_user' => array(
          'type' => 'INT',
          'constraint' => 5,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'user' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'pass' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
    ));
    $this->dbforge->add_key('id_user', TRUE);
    $this->dbforge->create_table('ep_admin_users');

    //creating admin settings...
    $this->dbforge->add_field(array(
        'id_setting' => array(
          'type' => 'INT',
          'constraint' => 5,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'value' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
    ));
    $this->dbforge->add_key('id_setting', TRUE);
    $this->dbforge->create_table('ep_admin_settings');

    //creating admin sessions...
    $this->dbforge->add_field(array(
        'session_id' => array(
          'type' => 'VARCHAR',
          'constraint' => 40,
          'default' => '0',
        ),
        'id_adress' => array(
          'type' => 'VARCHAR',
          'constraint' => '45',
          'default' => '0',
        ),
        'user_agent' => array(
          'type' => 'VARCHAR',
          'constraint' => '120',
        ),
        'last_activity' => array(
          'type' => 'INT',
          'constraint' => '10',
          'default' => '0',
          'unsigned' => TRUE,
        ),
        'user_data' => array(
          'type' => 'TEXT',
        ),
    ));
    $this->dbforge->add_key('session_id', TRUE);
    $this->dbforge->create_table('ep_admin_sessions');

    //creating modules...
    $this->dbforge->add_field(array(
        'id_module' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'nickname' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
    ));
    $this->dbforge->add_key('id_module', TRUE);
    $this->dbforge->create_table('ep_modules');

    //creating pages...
    $this->dbforge->add_field(array(
        'id_page' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'title' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'link_title' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'module' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'page_type' => array(
          'type' => 'INT',
          'constraint' => '11',
          'default' => '1',
        ),
        'content' => array(
          'type' => 'text',
        ),
        'sidebar_style' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'sidebar_left' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'sidebar_right' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
    ));
    $this->dbforge->add_key('id_page', TRUE);
    $this->dbforge->create_table('ep_pages');

    //creating sidebars...
    $this->dbforge->add_field(array(
        'id_sidebar' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'content' => array(
          'type' => 'TEXT',
        ),
    ));
    $this->dbforge->add_key('id_sidebar', TRUE);
    $this->dbforge->create_table('ep_sidebars');

    //creating themes...
    $this->dbforge->add_field(array(
        'id_theme' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'content' => array(
          'type' => 'INT',
          'constraint' => '1',
        ),
    ));
    $this->dbforge->add_key('id_theme', TRUE);
    $this->dbforge->create_table('ep_themes');

    // Seeds
    $ep_admin_settings_seed[1]['name'] = 'website_title';
    $ep_admin_settings_seed[1]['value'] = 'Website Title';

    $ep_admin_settings_seed[2]['name'] = 'website_logo';
    $ep_admin_settings_seed[2]['value'] = 'logo.png';

    $ep_admin_settings_seed[3]['name'] = 'website_copyright';
    $ep_admin_settings_seed[3]['value'] = 'Website Copyright';

    $ep_admin_settings_seed[4]['name'] = 'website_homepage';
    $ep_admin_settings_seed[4]['value'] = 'Website homepage';

    foreach ($ep_admin_settings_seed as $admin_setting) {
      $this->db->insert( "ep_admin_settings", $admin_setting );
    }

    $ep_admin_users[1]['user'] = 'admin';
    $ep_admin_users[1]['pass'] = '21232f297a57a5a743894a0e4a801fc3';

    foreach ($ep_admin_users as $admin_user) {
      $this->db->insert( "ep_admin_users", $admin_user );
    }

    $ep_modules[1]['name'] = 'Simple page';
    $ep_modules[1]['nickname'] = 'simple_page';

    foreach ($ep_modules as $admin_module) {
      $this->db->insert( "ep_modules", $admin_module );
    }

    $ep_pages[1]['title'] = 'Home';
    $ep_pages[1]['link_title'] = 'homepage';
    $ep_pages[1]['module'] = 'simple_page';
    $ep_pages[1]['page_type'] = '1';
    $ep_pages[1]['content'] = '<p>homepage</p>';
    $ep_pages[1]['sidebar_style'] = 'none';
    $ep_pages[1]['sidebar_left'] = '0';
    $ep_pages[1]['sidebar_right'] = '0';

    $ep_pages[2]['title'] = 'Simple Page';
    $ep_pages[2]['link_title'] = 'simple_page';
    $ep_pages[2]['module'] = 'simple_page';
    $ep_pages[2]['page_type'] = '1';
    $ep_pages[2]['content'] = '<p>Lorem ipsum</p>';
    $ep_pages[2]['sidebar_style'] = 'none';
    $ep_pages[2]['sidebar_left'] = '0';
    $ep_pages[2]['sidebar_right'] = '0';

    foreach ($ep_pages as $page) {
      $this->db->insert( "ep_pages", $page );
    }
  }

  public function down() {
    $this->dbforge->drop_database('easypanel');
  }
}