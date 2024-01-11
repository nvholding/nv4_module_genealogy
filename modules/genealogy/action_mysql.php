<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2024 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Thu, 11 Jan 2024 07:46:43 GMT
 */

if (!defined('NV_IS_FILE_MODULES'))
    die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_admins";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_bodyhtml_1";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_bodytext";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config_post";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_country";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_family";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_genealogy";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_logs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_tags";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_tags_id";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_ward";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id int(11) NOT NULL AUTO_INCREMENT,
  gid int(11) NOT NULL DEFAULT 0,
  parentid int(11) NOT NULL DEFAULT 0 COMMENT 'Là con của Ai, thường là bố',
  parentid2 int(11) NOT NULL DEFAULT 0 COMMENT 'Là con của mẹ nào',
  weight int(11) NOT NULL DEFAULT 0 COMMENT 'Là con/vợ thứ mấy (Thứ 2, 3 hay cả, hai, ba , tư..)',
  lev int(11) NOT NULL DEFAULT 0 COMMENT 'Đời thứ',
  relationships tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Quan hệ với người được chọn: Vợ/Con.',
  gender tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Nam/Nữ/Chưa biết',
  status tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Còn sống/ đã mất/ không rõ',
  anniversary_day varchar(10) NOT NULL DEFAULT '0' COMMENT 'Ngày giỗ',
  anniversary_mont varchar(10) NOT NULL DEFAULT '0' COMMENT 'Tháng giỗ',
  actanniversary tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Hiển thị ngày giỗ hay không',
  alias varchar(250) NOT NULL DEFAULT '',
  full_name varchar(250) NOT NULL COMMENT 'Tên húy (Là tên trong khai sinh, tên cúng cơm)',
  code varchar(50) NOT NULL COMMENT 'Số mã hiệu (Là số mã hiệu trong gia phả, nếu có)',
  name1 varchar(200) NOT NULL COMMENT 'Tên tự (Là tên tự gọi)',
  name2 varchar(200) NOT NULL COMMENT 'Là tên thụy phong, truy phong sau khi mất',
  birthday datetime NOT NULL COMMENT 'Ngày giờ sinh ',
  dieday datetime NOT NULL COMMENT 'Ngày giờ mất ',
  life int(11) NOT NULL DEFAULT 0 COMMENT 'Hưởng thọ',
  burial varchar(250) NOT NULL COMMENT 'Mộ táng tại',
  content mediumtext NOT NULL COMMENT 'Sự nghiệp, công đức của nguời này. (Nếu là nữ, ghi tên con, cháu ngoại cũng như các ghi chú khác vào đây.)',
  image varchar(250) NOT NULL COMMENT 'Upload đính kèm ảnh chân dung',
  userid int(11) NOT NULL DEFAULT 0,
  add_time int(11) NOT NULL DEFAULT 0,
  edit_time int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY gid (gid,alias),
  KEY parentid (parentid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_admins(
  userid mediumint(8) unsigned NOT NULL DEFAULT 0,
  fid smallint(5) NOT NULL DEFAULT 0,
  admin tinyint(4) NOT NULL DEFAULT 0,
  add_content tinyint(4) NOT NULL DEFAULT 0,
  pub_content tinyint(4) NOT NULL DEFAULT 0,
  edit_content tinyint(4) NOT NULL DEFAULT 0,
  del_content tinyint(4) NOT NULL DEFAULT 0,
  app_content tinyint(4) NOT NULL DEFAULT 0,
  UNIQUE KEY userid (userid,fid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_bodyhtml_1(
  id int(11) unsigned NOT NULL,
  bodyhtml longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  rule longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  content longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  imgposition tinyint(1) NOT NULL DEFAULT 1,
  copyright tinyint(1) NOT NULL DEFAULT 0,
  allowed_send tinyint(1) NOT NULL DEFAULT 0,
  allowed_print tinyint(1) NOT NULL DEFAULT 0,
  allowed_save tinyint(1) NOT NULL DEFAULT 0,
  gid mediumint(8) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_bodytext(
  id int(11) unsigned NOT NULL,
  bodytext mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  ruletext mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  contenttext mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config_post(
  group_id smallint(5) NOT NULL,
  addcontent tinyint(4) NOT NULL,
  postcontent tinyint(4) NOT NULL,
  editcontent tinyint(4) NOT NULL,
  delcontent tinyint(4) NOT NULL,
  PRIMARY KEY (group_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_country(
  countryid smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  code varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  alias varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  weight smallint(4) unsigned NOT NULL DEFAULT 0,
  status tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (countryid),
  UNIQUE KEY countryid (code)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district(
  districtid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  code varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  provinceid varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  title varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  alias varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  type varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  location varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  weight mediumint(8) unsigned NOT NULL DEFAULT 0,
  status tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (districtid),
  KEY provinceid (provinceid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_family(
  fid smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  status tinyint(4) NOT NULL DEFAULT 0,
  parentid smallint(5) unsigned NOT NULL DEFAULT 0,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  titlesite varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  alias varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  description text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  descriptionhtml text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  image varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  viewdescription tinyint(2) NOT NULL DEFAULT 0,
  weight smallint(5) unsigned NOT NULL DEFAULT 0,
  sort smallint(5) NOT NULL DEFAULT 0,
  lev smallint(5) NOT NULL DEFAULT 0,
  viewfam varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'view_location',
  numsubfam smallint(5) NOT NULL DEFAULT 0,
  subfid varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  inhome tinyint(1) unsigned NOT NULL DEFAULT 0,
  numlinks tinyint(2) unsigned NOT NULL DEFAULT 3,
  newday tinyint(2) unsigned NOT NULL DEFAULT 2,
  featured int(11) NOT NULL DEFAULT 0,
  keywords text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  admins text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  add_time int(11) unsigned NOT NULL DEFAULT 0,
  edit_time int(11) unsigned NOT NULL DEFAULT 0,
  groups_view varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (fid),
  UNIQUE KEY alias (alias),
  KEY parentid (parentid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_genealogy(
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  fid smallint(5) unsigned NOT NULL DEFAULT 0,
  listfid varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  admin_id mediumint(8) unsigned NOT NULL DEFAULT 0,
  author varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  patriarch varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  addtime int(11) unsigned NOT NULL DEFAULT 0,
  edittime int(11) unsigned NOT NULL DEFAULT 0,
  status tinyint(4) NOT NULL DEFAULT 1,
  publtime int(11) unsigned NOT NULL DEFAULT 0,
  exptime int(11) unsigned NOT NULL DEFAULT 0,
  archive tinyint(1) unsigned NOT NULL DEFAULT 0,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  alias varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  hometext text COLLATE utf8mb4_unicode_ci NOT NULL,
  homeimgfile varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  homeimgalt varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  homeimgthumb tinyint(4) NOT NULL DEFAULT 0,
  inhome tinyint(1) unsigned NOT NULL DEFAULT 0,
  allowed_comm varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  allowed_rating tinyint(1) unsigned NOT NULL DEFAULT 0,
  hitstotal mediumint(8) unsigned NOT NULL DEFAULT 0,
  hitscm mediumint(8) unsigned NOT NULL DEFAULT 0,
  total_rating int(11) NOT NULL DEFAULT 0,
  click_rating int(11) NOT NULL DEFAULT 0,
  number int(11) NOT NULL DEFAULT 0,
  years varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  full_name varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  telephone varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  email varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  cityid smallint(5) unsigned NOT NULL DEFAULT 0,
  districtid smallint(5) unsigned NOT NULL DEFAULT 0,
  wardid smallint(5) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY fid (fid),
  KEY admin_id (admin_id),
  KEY author (author),
  KEY title (title),
  KEY addtime (addtime),
  KEY publtime (publtime),
  KEY exptime (exptime),
  KEY status (status)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_logs(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  sid mediumint(8) NOT NULL DEFAULT 0,
  userid mediumint(8) unsigned NOT NULL DEFAULT 0,
  status tinyint(4) NOT NULL DEFAULT 0,
  note varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  set_time int(11) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY sid (sid),
  KEY userid (userid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province(
  provinceid mediumint(4) unsigned NOT NULL AUTO_INCREMENT,
  code varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  countryid varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  title varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  alias varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  type varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  weight smallint(4) unsigned NOT NULL DEFAULT 0,
  status tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (provinceid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_tags(
  tid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  numnews mediumint(8) NOT NULL DEFAULT 0,
  alias varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  image varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  description text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  keywords varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (tid),
  UNIQUE KEY alias (alias)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_tags_id(
  id int(11) NOT NULL,
  tid mediumint(9) NOT NULL,
  keyword varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY sid (id,tid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_ward(
  wardid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  districtid varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  title varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  alias varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  code varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  type varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  location varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  status tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (wardid),
  UNIQUE KEY alias (alias),
  UNIQUE KEY code (code),
  KEY districtid (districtid)
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'indexfile', 'view_location')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'per_page', '20')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'st_links', '10')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'homewidth', '100')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'homeheight', '150')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'blockwidth', '52')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'blockheight', '75')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'imagefull', '460')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'copyright', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'showtooltip', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'tooltip_position', 'bottom')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'tooltip_length', '150')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'showhometext', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'timecheckstatus', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'show_no_image', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowed_rating_point', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'facebookappid', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'socialbutton', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'alias_lower', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'tags_alias', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'auto_tags', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'tags_remind', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'structure_upload', 'username')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'imgposition', '2')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'auto_postcomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowed_comm', '-1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'view_comm', '6')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'setcomm', '4')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'activecomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'emailcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'adminscomm', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'sortcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'captcha', '1')";
