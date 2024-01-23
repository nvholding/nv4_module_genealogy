<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Holding (ceo@nvholding.vn)
 * @Copyright (C) 2020 NV Holding. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 01/01/2020 00:00
 */

if( ! defined( 'NV_IS_MOD_GENEALOGY' ) ) die( 'Stop!!!' );

if (defined('NV_IS_USER') OR defined('NV_IS_ADMIN'))
{
	$page = 1;
	if (isset($array_op[1]) and substr($array_op[1], 0, 5) == 'page-') {
		$page = (int) (substr($array_op[1], 5));
	}
	$per_page = 30;
	if(defined('NV_IS_USER')){
		
		$post_gid = $db->query("SELECT id FROM " . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . "_" . $module_data . "_genealogy WHERE admin_id=" . $user_info['userid']);
		$array_gid = array();
		while ($row = $post_gid->fetch()){
			$array_gid[]=$row['id'];
		}
		$array_list_gid = implode(',',$array_gid);
	}
	$page_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=member';
	/* if ($page > 1) {
		$page_url .= '/page-' . $page;
	} */
	$db->sqlreset()
		->select( 'COUNT(*)' )
		->from( $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . ' ' )
		->where( 'gid in ('. $array_list_gid .') ')
		;
	$num_items = $db->query( $db->sql() )->fetchColumn();
	$db->select( 'g.*, u.username, f.title as farmname,f.fid,f.alias as falias,  c.title as catname' )
		->from( $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . ' as g' )
		->join('LEFT JOIN ' . NV_USERS_GLOBALTABLE . ' as u ON g.userid = u.userid LEFT JOIN ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_genealogy as f ON g.gid = f.id LEFT JOIN ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block as bc ON g.id = bc.id LEFT JOIN ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat as c ON bc.bid = c.bid')
		->order( 'g.lev ASC' )
		->limit($per_page)
        ->offset(($page - 1) * $per_page);
	$result = $db->query( $db->sql() );
	
    $xtpl = new XTemplate("member.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file);

    $xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
    $xtpl->assign('OP', $op);

    $xtpl->assign('NV_SITE_COPYRIGHT', "" . $global_config['site_name'] . " [" . $global_config['site_email'] . "] ");
    $xtpl->assign('NV_SITE_NAME', $global_config['site_name']);
    $xtpl->assign('NV_SITE_TITLE', "" . $global_config['site_name'] . " " . NV_TITLEBAR_DEFIS . " " . $lang_global['admin_page'] . " " . NV_TITLEBAR_DEFIS . " " . $module_info['custom_title'] . "");
    $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
    $xtpl->assign('NV_ADMINDIR', NV_ADMINDIR);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('MODULE_FILE', $module_file);
    $xtpl->assign('TEMPLATE', $module_info['template']);

    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_LANG_INTERFACE', NV_LANG_INTERFACE);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_SITE_TIMEZONE_OFFSET', round(NV_SITE_TIMEZONE_OFFSET / 3600));
    $xtpl->assign('NV_CURRENTTIME', nv_date("T", NV_CURRENTTIME));
    $xtpl->assign('NV_COOKIE_PREFIX', $global_config['cookie_prefix']);
    $xtpl->assign('burial_address', $burial_address);

    while( $item = $result->fetch() )
	{
		$sqllistuser = $db->sqlreset()->query( 'SELECT max(lev) as maxlev FROM ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_'. $module_data .' WHERE gid = "' . $item['id'] . '" ORDER BY weight ASC' )->fetch();
		if($item['parentid'] > 0){
			$parentname = $db->sqlreset()->query( 'SELECT full_name FROM ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_'. $module_data .' WHERE id = "' . $item['parentid'] . '"' )->fetch();
			$item['parentname'] = $parentname['full_name'];
			$item['parentlink'] = $parentname['full_name'];
		}else{
			$item['parentname'] = "";
			$item['parentlink'] = "";
		}
		$item['maxlev']=$sqllistuser['maxlev'];
		if($item['gender'] == 1 && $item['relationships'] == 1){
			$item['class']='class="male"';
		}elseif($item['gender'] == 2 && $item['relationships'] == 1){
			$item['class']='class="female"';
		}else{
			$item['class']='class="female noadd"';
			
		}
		//die($item['id']);	
		if( $item['homeimgthumb'] == 1 )//image thumb
		{
			$item['src'] = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $item['homeimgfile'];
		}
		elseif( $item['homeimgthumb'] == 2 )//image file
		{
			$item['src'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $item['homeimgfile'];
		}
		elseif( $item['homeimgthumb'] == 3 )//image url
		{
			$item['src'] = $item['homeimgfile'];
		}
		elseif( ! empty( $show_no_image ) )//no image
		{
			$item['src'] = NV_BASE_SITEURL . $show_no_image;
		}
		else
		{
			$item['src'] = '';
		}

		$item['alt'] = ! empty( $item['homeimgalt'] ) ? $item['homeimgalt'] : $item['title'];
		$item['width'] = $module_config[$module_name]['homewidth'];

		//$end_weight++;
		//$item['weight']=$end_weight;
		//print_r($global_array_fam);
		$item['link'] = $global_array_fam[$item['fid']]['link'] . '/' . $item['falias'] . '/Pha-Do/' . $item['alias']  . $global_config['rewrite_exturl'];
		$item['farmlink'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=view' . '/' . $item['falias']  . $global_config['rewrite_exturl'];
		$item['linkmanager'] = $global_array_fam[$item['fid']]['link'] . '/' . $item['falias'] . '/Manager' . $global_config['rewrite_exturl'];
		$item_array[] = $item;
		$xtpl->assign('DATA', $item);
		$xtpl->parse('main.loop');
	}
	$result->closeCursor();
	$generate_page = nv_alias_page($page_title, $page_url, $num_items, $per_page, $page);
	if (!empty($generate_page)) {
        $xtpl->assign('GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.generate_page');
    }
    if (!empty($page_title))
    {
        $xtpl->assign('PAGE_TITLE', $page_title);
        $xtpl->parse('main.empty_page_title');
    }

    if (NV_LANG_INTERFACE == 'vi' and NV_LANG_DATA == 'vi')
    {
        $xtpl->parse('main.nv_if_mudim');
    }
    $xtpl->assign('NV_GENPASS', nv_genpass());
    $xtpl->parse('main');
    $contents = $xtpl->text('main');

    include (NV_ROOTDIR . "/includes/header.php");
    echo nv_site_theme($contents);
    include (NV_ROOTDIR . "/includes/footer.php");
}
else
{
    $redirect = "<meta http-equiv=\"Refresh\" content=\"2;URL=" . nv_url_rewrite(NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=users&" . NV_OP_VARIABLE . "=login&nv_redirect=" . nv_base64_encode($client_info['selfurl']), true) . "\" />";
    nv_info_die($nv_Lang->getModule('error_login_title'), $nv_Lang->getModule('error_login_title'), $nv_Lang->getModule('error_login_content') . $redirect);
}
