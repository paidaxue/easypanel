-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2015 at 05:09 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easypanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id_post` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id_post`, `title`, `image`, `content`, `date_created`) VALUES
(1, 'Flat design', '92.jpg', '<div>Ne mel cibo aliquam, latine ornatus te nam. Similique cotidieque omittantur id eos, est eu dictas appareat forensibus. Cum fugit sadipscing ut. Saepe munere delicatissimi per ea. Justo mediocrem argumentum eos te, erant congue denique at mea, te modus expetendis his.</div><div><p></p><p></p></div><div>Et modo vide argumentum cum, nam ei quidam postulant, ea mel laboramus disputando. Eam urbanitas forensibus ut, ex iriure docendi mei. Sed ei omnium indoctum. Vis ut numquam accusam percipitur.</div><div><br></div><div>Minim corpora no mel, saperet voluptaria posidonium at sea. Nam causae vulputate moderatius ad. At animal civibus usu, cu dicta platonem forensibus vis. No per enim incorrupte, est an simul latine.</div><div><br></div><div>Soleat vocibus abhorreant ne mel, unum insolens no per, mel vide praesent delicatissimi ex. At clita instructior eum. His phaedrum partiendo posidonium ex. Ei perfecto atomorum omittantur nam, nusquam conceptam temporibus te sed, mazim malorum definitiones ius ne.</div>', '2015-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `ep_admin_sessions`
--

CREATE TABLE IF NOT EXISTS `ep_admin_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `id_adress` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ep_admin_settings`
--

CREATE TABLE IF NOT EXISTS `ep_admin_settings` (
  `id_setting` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ep_admin_settings`
--

INSERT INTO `ep_admin_settings` (`id_setting`, `name`, `value`) VALUES
(1, 'website_title', 'Easypanel'),
(2, 'website_logo', 'logo.png'),
(3, 'website_copyright', '<p>© 2015 - <a href="http://www.yox64.com" title="Banyacskay Werner" target="_blank">Banyacskay Werner</a></p>'),
(4, 'website_homepage', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ep_admin_users`
--

CREATE TABLE IF NOT EXISTS `ep_admin_users` (
  `id_user` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ep_admin_users`
--

INSERT INTO `ep_admin_users` (`id_user`, `user`, `pass`, `fullname`, `email`, `avatar`) VALUES
(1, 'admin', '$1$bA3.Ib5.$0aMvbLek/MvCcpzfvja98.', 'Administrator', 'yox64@yahoo.com', 'account/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `ep_modules`
--

CREATE TABLE IF NOT EXISTS `ep_modules` (
  `id_module` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `module_slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ep_modules`
--

INSERT INTO `ep_modules` (`id_module`, `name`, `module_slug`) VALUES
(1, 'Simple page', 'simple_page'),
(7, 'Blog', 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `ep_pages`
--

CREATE TABLE IF NOT EXISTS `ep_pages` (
  `id_page` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `page_type` varchar(100) NOT NULL DEFAULT 'parent',
  `content` text NOT NULL,
  `sidebar_style` varchar(255) NOT NULL,
  `sidebar_left` varchar(255) NOT NULL,
  `sidebar_right` varchar(255) NOT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ep_pages`
--

INSERT INTO `ep_pages` (`id_page`, `title`, `page_slug`, `module`, `page_type`, `content`, `sidebar_style`, `sidebar_left`, `sidebar_right`) VALUES
(1, 'Home', 'home', 'simple_page', 'parent', '<p>Id sit partiendo intellegam liberavisse. Primis possim meliore eos an, et paulo salutandi usu. Per discere euismod utroque at. Vim ne sale aeque menandri. Sed erroribus disputando interpretaris no. No nisl sint cibo his.</p><p>Paulo exerci conceptam mel et, falli tibique ea nam. Ut nobis inermis eam, cum eu soluta utamur voluptatibus, fabellas constituam vix cu. Duo malis contentiones ex. Mea laoreet concludaturque ne, rebum iriure persecuti eum te, unum aeterno suscipiantur duo ne.</p><p>Ne inermis nominati scripserit nam. Singulis antiopam ut sea. Ius facete offendit id. Ius at aliquid phaedrum. Te diceret dolores quo, mel volumus mandamus ea. Eu mea veniam insolens, amet minimum eu vim.</p><p>Erant omnes maiestatis mea ne. Assum impedit argumentum ei eam, iusto quando ancillae eam et. Vix animal expetendis in, diam liber consetetur in duo, cu ius dicta legere accusamus. Quando menandri quo an, no ius vero scripta, usu nibh quaeque atomorum an.</p><p>Mei ad illum dolores definitiones. In idque principes definitiones usu, eam quem principes eu. Est no alterum fabellas, his adhuc voluptua interesset cu. Mea ne consulatu forensibus, per paulo graecis aliquando cu. Eos possit regione eripuit id, cu duo sale scaevola fabellas.</p><p></p><p>Movet referrentur efficiantur quo te, sed ullum mundi an. Congue deleniti scripserit eos id, quod insolens deseruisse per an. Modus omnes ea duo, sea nominavi expetendis ad. Mucius definitiones no his, eos et sale ludus integre, sed ludus aperiri argumentum ea. Populo consequat percipitur at has, magna atqui nullam ex sed. Nec cu rebum consul similique, no mazim nonumy persecuti sit.</p><p>Tritani consetetur at pri, mei feugait pertinax dissentias no. Vis quem decore voluptatum et. Exerci putant comprehensam pri an. Altera adipiscing et mea, duo gloriatur maiestatis et. Ea nusquam voluptaria intellegebat mea.</p>', 'none', '0', '0'),
(2, 'About', 'about', 'simple_page', 'parent', '<div class="col-md-9">\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum similique quo non illo voluptatibus veritatis. Magni sapiente tempore ea nisi dignissimos doloremque, quasi eligendi aut, atque tenetur nesciunt numquam velit.</p><p></p>\n</div>', 'right', '0', '1'),
(3, 'Services', 'services', 'simple_page', 'parent', '<p>No pro eirmod adipisci, cum et atqui homero. Vim eu zril maiestatis. Labore cetero gloriatur nam ei, agam facilis vix at. Te noster accusam pertinacia eum, vix eu eros gloriatur delicatissimi, lobortis ocurreret concludaturque no has. Amet viderer ius te.</p><p><br></p><p>Fugit eligendi apeirian an pri, ea has tota latine labitur, sed te suas nihil possim. Quo ut nihil voluptatibus, affert labores volutpat nam ex, essent oportere ad pri. Illum saepe id mei, quis vulputate pro id, aperiam omnesque ex mel. Ea purto equidem mea, nibh accusata volutpat mea te. Usu veri mucius cu.</p><p><br></p><p>Et tollit invidunt nec, iriure feugiat adversarium cu qui. Pri at tota nonumes, alii tale commune pri at, mei eu regione nostrum. Cum cu splendide constituam. Atqui timeam latine te est, his essent petentium dissentiet in. Nonumy lobortis te eam, mei tamquam deleniti in.</p><p><br></p><p>Nam ne cibo ridens delicatissimi, modus dicunt quaeque ne vix. Oporteat elaboraret cu eos, mei sanctus epicuri ei. Id verear corpora vis, id vel eirmod malorum verterem. Legimus oportere forensibus ex sed.</p><p><br></p><p>Discere salutandi suscipiantur ne vis. Quo ad natum adipiscing, mel erroribus dignissim id. Cu causae denique ius. Sit in graecis suscipit. Vel ea ullum splendide, eum in quot dolorum officiis, sit ea ridens diceret adversarium. Usu suas etiam facete ei, pro odio moderatius ut.</p>\n', 'none', '0', '0'),
(5, 'Blog', 'blog', 'blog', 'parent', '', 'none', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ep_sidebars`
--

CREATE TABLE IF NOT EXISTS `ep_sidebars` (
  `id_sidebar` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id_sidebar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ep_sidebars`
--

INSERT INTO `ep_sidebars` (`id_sidebar`, `name`, `content`) VALUES
(1, 'Blog slidebar', '<div class="col-md-3">\n<p>In unum dicant platonem vim, eam vidit inermis disputando cu. Ullum voluptatum sed ne, vel latine imperdiet elaboraret ne. Ludus dicant nominavi ius no, in semper regione veritus sed. Quem brute iuvaret no has.</p><p><br></p><p>No pro eirmod adipisci, cum et atqui homero. Vim eu zril maiestatis. Labore cetero gloriatur nam ei, agam facilis vix at. Te noster accusam pertinacia eum, vix eu eros gloriatur delicatissimi, lobortis ocurreret concludaturque no has. Amet viderer ius te.</p>\n</div>');

-- --------------------------------------------------------

--
-- Table structure for table `ep_themes`
--

CREATE TABLE IF NOT EXISTS `ep_themes` (
  `id_theme` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ep_themes`
--

INSERT INTO `ep_themes` (`id_theme`, `name`, `active`) VALUES
(1, 'blue', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
