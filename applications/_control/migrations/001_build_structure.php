<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Build_structure extends CI_Migration {

  public function up() {
    $this->load->dbforge();

    // creating admin users...
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
      'fullname' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'avatar' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
    ));
    $this->dbforge->add_key('id_user', TRUE);
    $this->dbforge->create_table('ep_admin_users');

    // adding content
    $ep_admin_users = array(
      array(
        'user'      => 'admin',
        'pass'      => '$1$bA3.Ib5.$0aMvbLek/MvCcpzfvja98.',
        'fullname'  => 'Administrator',
        'email'     => 'yox64@yahoo.com',
        'avatar'    => 'account/default.png',
      ),
    );

    foreach ($ep_admin_users as $admin_user) {
      $this->db->insert( "ep_admin_users", $admin_user );
    }

    // creating admin settings...
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

    // adding content
    $ep_admin_settings = array(
      array(
        'name'  => 'website_title',
        'value' => 'Easypanel',
      ),
      array(
        'name'  => 'website_logo',
        'value' => 'logo.png',
      ),
      array(
        'name'  => 'website_copyright',
        'value' => '<p>© 2015 - <a href="http://www.yox64.com" title="Banyacskay Werner" target="_blank">Banyacskay Werner</a></p>',
      ),
      array(
        'name'  => 'website_homepage',
        'value' => '1',
      ),
    );

    foreach ($ep_admin_settings as $admin_setting) {
      $this->db->insert( "ep_admin_settings", $admin_setting );
    }

    // creating admin sessions...
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

    // creating modules...
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
      'module_slug' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
    ));
    $this->dbforge->add_key('id_module', TRUE);
    $this->dbforge->create_table('ep_modules');

    // adding content
    $ep_modules = array(
      array(
        'name'        => 'Simple page',
        'module_slug' => 'simple_page',
      ),
      array(
        'name'        => 'Blog',
        'module_slug' => 'blog',
      ),
    );

    foreach ($ep_modules as $admin_module) {
      $this->db->insert( "ep_modules", $admin_module );
    }

    // creating pages...
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
      'page_slug' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'module' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'page_type' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
        'default' => 'parent',
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

    // adding content
    $ep_pages = array(
      array(
        'title'         => 'Home',
        'page_slug'     => 'home',
        'module'        => 'simple_page',
        'page_type'     => 'parent',
        'content'       => '<p>Id sit partiendo intellegam liberavisse. Primis possim meliore eos an, et paulo salutandi usu. Per discere euismod utroque at. Vim ne sale aeque menandri. Sed erroribus disputando interpretaris no. No nisl sint cibo his.</p><p>Paulo exerci conceptam mel et, falli tibique ea nam. Ut nobis inermis eam, cum eu soluta utamur voluptatibus, fabellas constituam vix cu. Duo malis contentiones ex. Mea laoreet concludaturque ne, rebum iriure persecuti eum te, unum aeterno suscipiantur duo ne.</p><p>Ne inermis nominati scripserit nam. Singulis antiopam ut sea. Ius facete offendit id. Ius at aliquid phaedrum. Te diceret dolores quo, mel volumus mandamus ea. Eu mea veniam insolens, amet minimum eu vim.</p><p>Erant omnes maiestatis mea ne. Assum impedit argumentum ei eam, iusto quando ancillae eam et. Vix animal expetendis in, diam liber consetetur in duo, cu ius dicta legere accusamus. Quando menandri quo an, no ius vero scripta, usu nibh quaeque atomorum an.</p><p>Mei ad illum dolores definitiones. In idque principes definitiones usu, eam quem principes eu. Est no alterum fabellas, his adhuc voluptua interesset cu. Mea ne consulatu forensibus, per paulo graecis aliquando cu. Eos possit regione eripuit id, cu duo sale scaevola fabellas.</p><p></p><p>Movet referrentur efficiantur quo te, sed ullum mundi an. Congue deleniti scripserit eos id, quod insolens deseruisse per an. Modus omnes ea duo, sea nominavi expetendis ad. Mucius definitiones no his, eos et sale ludus integre, sed ludus aperiri argumentum ea. Populo consequat percipitur at has, magna atqui nullam ex sed. Nec cu rebum consul similique, no mazim nonumy persecuti sit.</p><p>Tritani consetetur at pri, mei feugait pertinax dissentias no. Vis quem decore voluptatum et. Exerci putant comprehensam pri an. Altera adipiscing et mea, duo gloriatur maiestatis et. Ea nusquam voluptaria intellegebat mea.</p>',
        'sidebar_style' => 'none',
        'sidebar_left'  => '0',
        'sidebar_right' => '0',
      ),
      array(
        'title'         => 'About',
        'page_slug'     => 'about',
        'module'        => 'simple_page',
        'page_type'     => 'parent',
        'content'       => '<div class="col-md-9"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum similique quo non illo voluptatibus veritatis. Magni sapiente tempore ea nisi dignissimos doloremque, quasi eligendi aut, atque tenetur nesciunt numquam velit.</p><p></p></div>',
        'sidebar_style' => 'none',
        'sidebar_left'  => '0',
        'sidebar_right' => '1',
      ),
      array(
        'title'         => 'Services',
        'page_slug'     => 'services',
        'module'        => 'simple_page',
        'page_type'     => 'parent',
        'content'       => '<p>No pro eirmod adipisci, cum et atqui homero. Vim eu zril maiestatis. Labore cetero gloriatur nam ei, agam facilis vix at. Te noster accusam pertinacia eum, vix eu eros gloriatur delicatissimi, lobortis ocurreret concludaturque no has. Amet viderer ius te.</p><p><br></p><p>Fugit eligendi apeirian an pri, ea has tota latine labitur, sed te suas nihil possim. Quo ut nihil voluptatibus, affert labores volutpat nam ex, essent oportere ad pri. Illum saepe id mei, quis vulputate pro id, aperiam omnesque ex mel. Ea purto equidem mea, nibh accusata volutpat mea te. Usu veri mucius cu.</p><p><br></p><p>Et tollit invidunt nec, iriure feugiat adversarium cu qui. Pri at tota nonumes, alii tale commune pri at, mei eu regione nostrum. Cum cu splendide constituam. Atqui timeam latine te est, his essent petentium dissentiet in. Nonumy lobortis te eam, mei tamquam deleniti in.</p><p><br></p><p>Nam ne cibo ridens delicatissimi, modus dicunt quaeque ne vix. Oporteat elaboraret cu eos, mei sanctus epicuri ei. Id verear corpora vis, id vel eirmod malorum verterem. Legimus oportere forensibus ex sed.</p><p><br></p><p>Discere salutandi suscipiantur ne vis. Quo ad natum adipiscing, mel erroribus dignissim id. Cu causae denique ius. Sit in graecis suscipit. Vel ea ullum splendide, eum in quot dolorum officiis, sit ea ridens diceret adversarium. Usu suas etiam facete ei, pro odio moderatius ut.</p>',
        'sidebar_style' => 'none',
        'sidebar_left'  => '0',
        'sidebar_right' => '0',
      ),
      array(
        'title'         => 'Blog',
        'page_slug'     => 'blog',
        'module'        => 'blog',
        'page_type'     => 'parent',
        'content'       => '',
        'sidebar_style' => 'none',
        'sidebar_left'  => '0',
        'sidebar_right' => '0',
      )
    );

    foreach ($ep_pages as $page) {
      $this->db->insert("ep_pages", $page);
    }

    // creating sidebars...
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

    // adding content
    $ep_sidebars = array(
      array(
        'name'        => 'Blog sidebar',
        'module_slug' => '<div class="col-md-3"><p>In unum dicant platonem vim, eam vidit inermis disputando cu. Ullum voluptatum sed ne, vel latine imperdiet elaboraret ne. Ludus dicant nominavi ius no, in semper regione veritus sed. Quem brute iuvaret no has.</p><p><br></p><p>No pro eirmod adipisci, cum et atqui homero. Vim eu zril maiestatis. Labore cetero gloriatur nam ei, agam facilis vix at. Te noster accusam pertinacia eum, vix eu eros gloriatur delicatissimi, lobortis ocurreret concludaturque no has. Amet viderer ius te.</p></div>',
      ),
    );

    foreach ($ep_sidebars as $ep_sidebar) {
      $this->db->insert( "ep_sidebars", $ep_sidebar );
    }

    // creating themes...
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
      'active' => array(
        'type' => 'INT',
        'constraint' => '1',
        'default' => '0'
      ),
    ));
    $this->dbforge->add_key('id_theme', TRUE);
    $this->dbforge->create_table('ep_themes');

    // adding content
    $ep_themes = array(
      array(
        'name'    => 'blue',
        'active'  => '0',
      ),
    );

    foreach ($ep_themes as $themes) {
      $this->db->insert("ep_themes", $themes);
    }

    // creating blog module...
    $this->dbforge->add_field(
      array(
        'id_post' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
        'title' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
        'image' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
        'content' => array(
        'type' => 'TEXT',
      ),
        'date_created' => array(
        'type' => 'DATE',
      ),
    ));
    $this->dbforge->add_key('id_post', TRUE);
    $this->dbforge->create_table('blog');

    // adding content
    $blog = array(
      array(
        'title'         => 'Flat Design',
        'image'         => '92.jpg',
        'content'       => '<div>Ne mel cibo aliquam, latine ornatus te nam. Similique cotidieque omittantur id eos, est eu dictas appareat forensibus. Cum fugit sadipscing ut. Saepe munere delicatissimi per ea. Justo mediocrem argumentum eos te, erant congue denique at mea, te modus expetendis his.</div><div><p></p><p></p></div><div>Et modo vide argumentum cum, nam ei quidam postulant, ea mel laboramus disputando. Eam urbanitas forensibus ut, ex iriure docendi mei. Sed ei omnium indoctum. Vis ut numquam accusam percipitur.</div><div><br></div><div>Minim corpora no mel, saperet voluptaria posidonium at sea. Nam causae vulputate moderatius ad. At animal civibus usu, cu dicta platonem forensibus vis. No per enim incorrupte, est an simul latine.</div><div><br></div><div>Soleat vocibus abhorreant ne mel, unum insolens no per, mel vide praesent delicatissimi ex. At clita instructior eum. His phaedrum partiendo posidonium ex. Ei perfecto atomorum omittantur nam, nusquam conceptam temporibus te sed, mazim malorum definitiones ius ne.</div>',
        'date_created'  => '2015-03-31',
      ),
    );

    foreach ($blog as $blog_post) {
      $this->db->insert("blog", $blog_post);
    }
  }

  public function down() {
    $this->dbforge->drop_database('easypanel');
  }
}