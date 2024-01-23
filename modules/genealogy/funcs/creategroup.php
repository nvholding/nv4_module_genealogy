<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2024 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_MOD_GENEALOGY'))
    die('Stop!!!');
if (defined('NV_IS_USER') OR defined('NV_IS_ADMIN'))
{
	if ($nv_Request->isset_request('get_alias_title', 'post')) {
		$alias = $nv_Request->get_title('get_alias_title', 'post', '');
		$alias = change_alias($alias);
		die($alias);
	}
	$catid = $nv_Request->get_int('catid', 'post,get', 0);
	if ($nv_Request->isset_request('ajax_action', 'post')) {
		$bid = $nv_Request->get_int('bid', 'post', 0);
		$new_vid = $nv_Request->get_int('new_vid', 'post', 0);
		$content = 'NO_' . $bid;
		if ($new_vid > 0)     {
			$sql = 'SELECT bid FROM ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat WHERE bid!=' . $bid . ' AND userid ="' . $user_info['userid'] . '" ORDER BY weight ASC';
			$result = $db->query($sql);
			$weight = 0;
			while ($row = $result->fetch())
			{
				++$weight;
				if ($weight == $new_vid) ++$weight;             $sql = 'UPDATE ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat SET weight=' . $weight . ' WHERE bid=' . $row['bid'];
				$db->query($sql);
			}
			$sql = 'UPDATE ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat SET weight=' . $new_vid . ' WHERE bid=' . $bid;
			$db->query($sql);
			$content = 'OK_' . $bid;
		}
		$nv_Cache->delMod($module_name);
		include NV_ROOTDIR . '/includes/header.php';
		echo $content;
		include NV_ROOTDIR . '/includes/footer.php';
	}

	if ($nv_Request->isset_request('delete_bid', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
		$bid = $nv_Request->get_int('delete_bid', 'get');
		$delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
		if ($bid > 0 and $delete_checkss == md5($bid . NV_CACHE_PREFIX . $client_info['session_id'])) {
			$weight=0;
			$sql = 'SELECT weight FROM ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat WHERE bid =' . $db->quote($bid);
			$result = $db->query($sql);
			list($weight) = $result->fetch(3);
			
			$db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat  WHERE bid = ' . $db->quote($bid));
			if ($weight > 0)         {
				$sql = 'SELECT bid, weight FROM ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat WHERE weight >' . $weight;
				$result = $db->query($sql);
				while (list($bid, $weight) = $result->fetch(3))
				{
					$weight--;
					$db->query('UPDATE ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat SET weight=' . $weight . ' WHERE bid=' . intval($bid));
				}
			}
			$nv_Cache->delMod($module_name);
			nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Creategroup', 'ID: ' . $bid, $admin_info['userid']);
			nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
		}
	}

	$row = array();
	$error = array();

	if ($nv_Request->isset_request('savecat', 'post')) {
		$row['bid'] = $nv_Request->get_int('bid', 'post,get', 0);
		$row['adddefault'] = $nv_Request->get_int('adddefault', 'post', 0);
		$row['title'] = $nv_Request->get_title('title', 'post', '');
		$row['alias'] = $nv_Request->get_title('alias', 'post', '');
		$row['alias'] = (empty($row['alias'])) ? change_alias($row['title']) : change_alias($row['alias']);
		$row['image'] = $nv_Request->get_title('image', 'post', '');
		$row['description'] = $nv_Request->get_title('description', 'post', '');
		$row['keywords'] = $nv_Request->get_textarea('keywords', '', NV_ALLOWED_HTML_TAGS);

		if (empty($row['title'])) {
			$error[] = $nv_Lang->getModule('error_required_title');
		}

		if (empty($error)) {
			try {
				if (empty($row['bid'])) {
					$row['numbers'] = 10;
					$row['add_time'] = 0;
					$row['edit_time'] = 0;

					$stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat (adddefault, numbers, catid, title, alias, image, description, weight, keywords, add_time, edit_time, userid) VALUES (:adddefault, :numbers,:catid, :title, :alias, :image, :description, :weight, :keywords, :add_time, :edit_time, "' . $user_info['userid'] . '")');

					$stmt->bindParam(':catid', $catid, PDO::PARAM_INT);
					$stmt->bindParam(':numbers', $row['numbers'], PDO::PARAM_INT);
					$weight = $db->query('SELECT max(weight) FROM ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat')->fetchColumn();
					$weight = intval($weight) + 1;
					$stmt->bindParam(':weight', $weight, PDO::PARAM_INT);

					$stmt->bindParam(':add_time', $row['add_time'], PDO::PARAM_INT);
					$stmt->bindParam(':edit_time', $row['edit_time'], PDO::PARAM_INT);

				} else {
					$stmt = $db->prepare('UPDATE ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat SET adddefault = :adddefault, title = :title, alias = :alias, image = :image, description = :description, keywords = :keywords WHERE bid=' . $row['bid']);
				}
				$stmt->bindParam(':adddefault', $row['adddefault'], PDO::PARAM_INT);
				$stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
				$stmt->bindParam(':alias', $row['alias'], PDO::PARAM_STR);
				$stmt->bindParam(':image', $row['image'], PDO::PARAM_STR);
				$stmt->bindParam(':description', $row['description'], PDO::PARAM_STR);
				$stmt->bindParam(':keywords', $row['keywords'], PDO::PARAM_STR, strlen($row['keywords']));

				$exc = $stmt->execute();
				if ($exc) {
					nv_fix_block_cat_order($user_info['userid']);
					$nv_Cache->delMod($module_name);
					if (empty($row['bid'])) {
						nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Creategroup', ' ', $user_info['userid']);
					} else {
						nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Creategroup', 'ID: ' . $row['bid'], $user_info['userid']);
					}
					nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&catid=' . $catid);
				}
			} catch(PDOException $e) {
				trigger_error($e->getMessage());
				die($e->getMessage()); //Remove this line after checks finished
			}
		}
	} elseif ($row['bid'] > 0) {
		$row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat WHERE bid=' . $row['bid'])->fetch();
		if (empty($row)) {
			nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
		}
	} else {
		$row['bid'] = 0;
		$row['catid'] = $catid;
		$row['adddefault'] = 0;
		$row['title'] = '';
		$row['alias'] = '';
		$row['image'] = '';
		$row['description'] = '';
		$row['keywords'] = 'NULL';
	}

	$row['keywords'] = nv_htmlspecialchars(nv_br2nl($row['keywords']));


	$q = $nv_Request->get_title('q', 'post,get');

	// Fetch Limit
	$show_view = false;
	if (!$nv_Request->isset_request('bid', 'post,get')) {
		$show_view = true;
		$per_page = 20;
		$page = $nv_Request->get_int('page', 'post,get', 1);
		$db->sqlreset()
			->select('COUNT(*)')
			->from('' . $db_config['dbsystem'] . '.' . NV_PREFIXLANG . '_' . $module_data . '_block_cat');

		$where = 'userid = "' . $user_info['userid'] . '"';
		if($catid > 0){
			$where .= ' AND catid = ' . $catid ;
		}else{
			$where .= ' AND catid = ' . $catid ;
		}
			$db->where($where );
		
		$sth = $db->prepare($db->sql());

	 
		$sth->execute();
		$num_items = $sth->fetchColumn();

		$db->select('*')
			->order('lev ASC, weight ASC')
			->limit($per_page)
			->offset(($page - 1) * $per_page);
		$sth = $db->prepare($db->sql());


		$sth->execute();
		
		$db->select('*')			->order('weight ASC');
			$db->where('userid = "' . $user_info['userid'] . '" AND catid = 0' );
		$sthc = $db->prepare($db->sql());


		$sthc->execute();
	}
	
	$xtpl = new XTemplate('creategroup.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
	$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
	$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
	$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
	$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
	$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
	$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
	$xtpl->assign('MODULE_NAME', $module_name);
	$xtpl->assign('MODULE_UPLOAD', $module_upload);
	$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
	$xtpl->assign('OP', $op);
	$xtpl->assign('DATA', $row);

	$xtpl->assign('Q', $q);

	if ($show_view) {
		$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
		if (!empty($q)) {
			$base_url .= '&q=' . $q;
		}
		$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
		if (!empty($generate_page)) {
			$xtpl->assign('NV_GENERATE_PAGE', $generate_page);
			$xtpl->parse('main.view.generate_page');
		}
		$number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
		while ($view = $sth->fetch()) {
			for($i = 1; $i <= $num_items; ++$i) {
				$xtpl->assign('WEIGHT', array(
					'key' => $i,
					'title' => $i,
					'selected' => ($i == $view['weight']) ? ' selected="selected"' : ''));
				$xtpl->parse('main.view.loop.weight_loop');
			}
			$view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;bid=' . $view['bid'];
			$view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_bid=' . $view['bid'] . '&amp;delete_checkss=' . md5($view['bid'] . NV_CACHE_PREFIX . $client_info['session_id']);
			$xtpl->assign('ROW', $view);
			$xtpl->parse('main.view.loop');
		}
		
		$xtpl->parse('main.view');
	}


	if (!empty($error)) {
		$xtpl->assign('ERROR', implode('<br />', $error));
		$xtpl->parse('main.error');
	}
	if (empty($row['bid'])) {
		$xtpl->parse('main.auto_get_alias');
	}
	while ($view = $sthc->fetch()) {
		
			$xtpl->assign('pcatid_i', $view['bid']);
			$xtpl->assign('ptitle_i', $view['title']);
			$xtpl->assign('pselect', ($view['bid'] == $catid) ? 'selected' : '');
			$xtpl->parse('main.parent_loop');
		}
	$xtpl->parse('main');
	$contents = $xtpl->text('main');

	$page_title = $nv_Lang->getModule('creategroup');

	include NV_ROOTDIR . '/includes/header.php';
	echo nv_site_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';
}
else
{
    $redirect = "<meta http-equiv=\"Refresh\" content=\"2;URL=" . nv_url_rewrite(NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=users&" . NV_OP_VARIABLE . "=login&nv_redirect=" . nv_base64_encode($client_info['selfurl']), true) . "\" />";
    nv_info_die($nv_Lang->getModule('error_login_title'), $nv_Lang->getModule('error_login_title'), $nv_Lang->getModule('error_login_content') . $redirect);
}