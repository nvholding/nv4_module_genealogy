<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Holding (ceo@nvholding.vn)
 * @Copyright (C) 2020 NV Holding. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 01/01/2020 00:00
 */

if( ! defined( 'NV_IS_MOD_GENEALOGY' ) ) die( 'Stop!!!' );

if( ! defined( 'NV_MODULE_LOCATION' ) ){
	$contents = '<p class="note_fam">' . $nv_Lang->getModule('note_location') . '</p>';
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';
	die();
	
	
}

$contents = '';
$publtime = 0;
$alias_made_up=change_alias($nv_Lang->getModule('made_up'));
$alias_convention=change_alias($nv_Lang->getModule('convention'));
$alias_collapse=change_alias($nv_Lang->getModule('collapse'));
$alias_anniversary=change_alias($nv_Lang->getModule('anniversary'));
$alias_family_tree=change_alias($nv_Lang->getModule('family_tree'));
$array_relationships = array(1 => $nv_Lang->getModule('u_relationships_1'), 2 => $nv_Lang->getModule('u_relationships_2'), 3 => $nv_Lang->getModule('u_relationships_3'));
$array_gender = array(0 => $nv_Lang->getModule('u_gender_0'), 1 => $nv_Lang->getModule('u_gender_1'), 2 => $nv_Lang->getModule('u_gender_2'));
$array_status = array(0 => $nv_Lang->getModule('u_status_0'), 1 => $nv_Lang->getModule('u_status_1'), 2 => $nv_Lang->getModule('u_status_2'));
$data_config = array(
        'select_countryid' => $nv_Request->get_int('select_countryid', 'post,get', 0),
        'allow_country' => $nv_Request->get_title('allow_country', 'post,get', ''),
        'allow_province' => $nv_Request->get_title('allow_province', 'post,get', ''),
        'allow_district' => $nv_Request->get_title('allow_district', 'post,get', ''),
        'allow_ward' => $nv_Request->get_title('allow_ward', 'post,get', ''),
        'multiple_province' => $nv_Request->get_int('multiple_province', 'post,get', 0),
        'multiple_district' => $nv_Request->get_int('multiple_district', 'post,get', 0),
        'multiple_ward' => $nv_Request->get_int('multiple_ward', 'post,get', 0),
        'is_district' => $nv_Request->get_int('is_district', 'post,get', 0),
        'is_ward' => $nv_Request->get_int('is_ward', 'post,get', 0),
        'blank_title_country' => $nv_Request->get_int('blank_title_country', 'post,get', 0),
        'blank_title_province' => $nv_Request->get_int('blank_title_province', 'post,get', 0),
        'blank_title_district' => $nv_Request->get_int('blank_title_district', 'post,get', 0),
        'blank_title_ward' => $nv_Request->get_int('blank_title_ward', 'post,get', 0),
        'name_country' => $nv_Request->get_title('name_country', 'post,get', 'countryid'),
        'name_province' => $nv_Request->get_title('name_province', 'post,get', 'provinceid'),
        'name_district' => $nv_Request->get_title('name_district', 'post,get', 'districtid'),
        'name_ward' => $nv_Request->get_title('name_ward', 'post,get', 'wardid'),
        'index' => $nv_Request->get_int('index', 'post,get', 0),
        'col_class' => $nv_Request->get_title('col_class', 'post,get', 'col-xs-24 col-sm-8 col-md-8')
    );
    
    $data_config['select_provinceid'] = $nv_Request->get_title('select_provinceid', 'post,get', '');
    $data_config['select_districtid'] = $nv_Request->get_title('select_districtid', 'post,get', '');
    $data_config['select_wardid'] = $nv_Request->get_title('select_wardid', 'post,get', '');
    
if( ! defined( 'NV_IS_USER' ) )
{
	$url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login';
	$nv_redirect = nv_get_redirect();
	if( ! empty( $nv_redirect ) ) $url .= '&nv_redirect=' . $nv_redirect;
	Header( 'Location: ' . nv_url_rewrite( $url, true ) );
	exit();
}
else
{	

	if ($nv_Request->get_string('submit', 'post') != "")
	{
		$news_contents['id'] = $nv_Request->get_int('id', 'post', 0);
		$news_contents['title'] = $nv_Request->get_string('title', 'post', '', 1);
		$news_contents['fid'] = $nv_Request->get_int('fid', 'post', 0);
		$news_contents['cityid'] = $nv_Request->get_int('provinceid', 'post', 0);
		$news_contents['districtid'] = $nv_Request->get_int('districtid', 'post', 0);
		$news_contents['wardid'] = $nv_Request->get_int('wardid', 'post', 0);
		$news_contents['bodytext'] = $nv_Request->get_string('bodytext', 'post', '');
		$news_contents['bodytext'] = defined('NV_EDITOR') ? nv_nl2br($news_contents['bodytext'], '') : nv_nl2br(nv_htmlspecialchars(strip_tags($news_contents['bodytext'])), '<br />');
		$news_contents['bodyhtml'] = $news_contents['bodytext'];
		$news_contents['listfid'] =  $news_contents['fid'];
		//$news_contents['listfid'] = implode( ',', $news_contents['fid'] );
		$fids = [];
		$fids[] = $news_contents['fid'];
		$news_contents['rule'] = $nv_Request->get_string('rule', 'post', '');
		$news_contents['rule'] = defined('NV_EDITOR') ? nv_nl2br($news_contents['rule'], '') : nv_nl2br(nv_htmlspecialchars(strip_tags($news_contents['rule'])), '<br />');
		$news_contents['ruletext'] = $news_contents['rule'];
		$news_contents['content'] = $nv_Request->get_string('content', 'post', '');
		$news_contents['content'] = defined('NV_EDITOR') ? nv_nl2br($news_contents['content'], '') : nv_nl2br(nv_htmlspecialchars(strip_tags($news_contents['content'])), '<br />');
		$news_contents['contenttext'] = $news_contents['content'];
		$news_contents['years'] = $nv_Request->get_string('years', 'post', '', 1);
		$news_contents['author'] = $nv_Request->get_string('author', 'post', '', 1);
		$news_contents['patriarch'] = $nv_Request->get_string('patriarch', 'post', '', 1);
		$news_contents['full_name'] = $nv_Request->get_string('full_name', 'post', '', 1);
		$news_contents['telephone'] = $nv_Request->get_string('telephone', 'post', '', 1);
		$news_contents['email'] = $nv_Request->get_string('email', 'post', '', 1);
		if(defined( 'NV_IS_ADMIN' ))
		{
			$news_contents['admin_id']= $admin_info['userid'];
		}else{
			$news_contents['admin_id']= $user_info['userid'];
		}
		if (empty($news_contents['id']) and $news_contents['cityid'] > 0)
		{
			// Xử lý liên kết tĩnh
			$alias = $nv_Request->get_title( 'alias', 'post', '' );
			if( empty( $alias ) )
			{
				$alias = change_alias( $news_contents['title'] );
				if( $module_config[$module_name]['alias_lower'] ) $alias = strtolower( $alias );
			}
			else
			{
				$alias = change_alias( $alias );
			}

			if( empty( $alias ) or ! preg_match( "/^([a-zA-Z0-9\_\-]+)$/", $alias ) )
			{
				if( empty( $news_contents['alias'] ) )
				{
					$news_contents['alias'] = 'post';
				}
			}
			else
			{
				$news_contents['alias'] = $alias;
			}
			// Xu ly anh minh hoa
			$news_contents['homeimgthumb'] = 0;
			if( ! nv_is_url( $news_contents['homeimgfile'] ) and is_file( NV_DOCUMENT_ROOT . $news_contents['homeimgfile'] ) )
			{
				$lu = strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' );
				$news_contents['homeimgfile'] = substr( $news_contents['homeimgfile'], $lu );
				if( file_exists( NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload . '/' . $news_contents['homeimgfile'] ) )
				{
					$news_contents['homeimgthumb'] = 1;
				}
				else
				{
					$news_contents['homeimgthumb'] = 2;
				}
			}
			elseif( nv_is_url( $news_contents['homeimgfile'] ) )
			{
				$news_contents['homeimgthumb'] = 3;
			}
			else
			{
				$news_contents['homeimgfile'] = '';
			}
			$news_contents['hometext'] = $nv_Request->get_textarea( 'hometext', '', 'br', 1 );

			$news_contents['homeimgfile'] = $nv_Request->get_title( 'homeimg', 'post', '' );
			$news_contents['homeimgalt'] = $nv_Request->get_title( 'homeimgalt', 'post', '', 1 );
			$news_contents['imgposition'] = $nv_Request->get_int( 'imgposition', 'post', 0 );
			if( ! array_key_exists( $news_contents['imgposition'], $array_imgposition ) )
			{
				$news_contents['imgposition'] = 1;
			}
			$news_contents['copyright'] = ( int )$nv_Request->get_bool( 'copyright', 'post' );
			$_groups_post = $nv_Request->get_array( 'allowed_comm', 'post', array() );
			$news_contents['allowed_comm'] = ! empty( $_groups_post ) ? implode( ',', nv_groups_post( array_intersect( $_groups_post, array_keys( $groups_list ) ) ) ) : '';

			$news_contents['allowed_rating'] = ( int )$nv_Request->get_bool( 'allowed_rating', 'post' );
			$news_contents['allowed_send'] = ( int )$nv_Request->get_bool( 'allowed_send', 'post' );
			$news_contents['allowed_print'] = ( int )$nv_Request->get_bool( 'allowed_print', 'post' );
			$news_contents['allowed_save'] = ( int )$nv_Request->get_bool( 'allowed_save', 'post' );
			$news_contents['keywords'] = $nv_Request->get_array( 'keywords', 'post', '' );
			$news_contents['keywords'] = implode(', ', $news_contents['keywords'] );
			$news_contents['gid'] = $nv_Request->get_int( 'gid', 'post', 0 );
			$news_contents['status'] = 1;
			$news_contents['publtime'] = NV_CURRENTTIME;
			$news_contents['addtime'] = NV_CURRENTTIME;
			$news_contents['edittime'] = NV_CURRENTTIME;
			
			$sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_genealogy
				(fid, listfid, admin_id, author, patriarch, addtime, edittime, status, publtime, exptime, archive, title, alias, hometext, homeimgfile, homeimgalt, homeimgthumb, inhome, allowed_comm, allowed_rating, hitstotal, hitscm, total_rating, click_rating, cityid, districtid, wardid, years, full_name, telephone, email) VALUES
				 (' . intval( $news_contents['fid'] ) . ',
				 :listfid,
				 ' . intval( $news_contents['admin_id'] ) . ',
				 :author,
				 :patriarch,
				 ' . intval( $news_contents['addtime'] ) . ',
				 ' . intval( $news_contents['edittime'] ) . ',
				 ' . intval( $news_contents['status'] ) . ',
				 ' . intval( $news_contents['publtime'] ) . ',
				 ' . intval( $news_contents['exptime'] ) . ',
				 ' . intval( $news_contents['archive'] ) . ',
				 :title,
				 :alias,
				 :hometext,
				 :homeimgfile,
				 :homeimgalt,
				 :homeimgthumb,
				 ' . intval( $news_contents['inhome'] ) . ',
				 :allowed_comm,
				 ' . intval( $news_contents['allowed_rating'] ) . ',
				 ' . intval( $news_contents['hitstotal'] ) . ',
				 ' . intval( $news_contents['hitscm'] ) . ',
				 ' . intval( $news_contents['total_rating'] ) . ',
				 ' . intval( $news_contents['click_rating'] ) . ',
				 ' . intval( $news_contents['cityid'] ) . ',
				 ' . intval( $news_contents['districtid'] ) . ',
				 ' . intval( $news_contents['wardid'] ) . ',
				 :years,
				 :full_name,
				 :telephone,
				 :email
				 
				 )';

			$data_insert = array();
			$data_insert['listfid'] = $news_contents['listfid'];
			$data_insert['author'] = $news_contents['author'];
			$data_insert['patriarch'] = $news_contents['patriarch'];
			$data_insert['title'] = $news_contents['title'];
			$data_insert['alias'] = $news_contents['alias'];
			$data_insert['hometext'] = $news_contents['hometext'];
			$data_insert['homeimgfile'] = $news_contents['homeimgfile'];
			$data_insert['homeimgalt'] = $news_contents['homeimgalt'];
			$data_insert['homeimgthumb'] = $news_contents['homeimgthumb'];
			$data_insert['allowed_comm'] = $news_contents['allowed_comm'];
			$data_insert['years'] = $news_contents['years'];
			$data_insert['full_name'] = $news_contents['full_name'];
			$data_insert['telephone'] = $news_contents['telephone'];
			$data_insert['email'] = $news_contents['email'];
			//print_r($news_contents['id']);
			$news_contents['id'] = $db->insert_id( $sql, 'id', $data_insert );

			if( $news_contents['id'] > 0 )
			{
				
				nv_insert_logs( NV_LANG_DATA, $module_name, $nv_Lang->getModule('genealogy_add'), $news_contents['title'], $news_contents['admin_id'] );
				$ct_query = array();
				$tbhtml = NV_PREFIXLANG . '_' . $module_data . '_bodyhtml_' . ceil( $news_contents['id'] / 2000 );
				$db->query( "CREATE TABLE IF NOT EXISTS " . $tbhtml . " (id int(11) unsigned NOT NULL, bodyhtml longtext NOT NULL, rule longtext NOT NULL, content longtext NOT NULL, imgposition tinyint(1) NOT NULL default '1', copyright tinyint(1) NOT NULL default '0', allowed_send tinyint(1) NOT NULL default '0', allowed_print tinyint(1) NOT NULL default '0', allowed_save tinyint(1) NOT NULL default '0', gid mediumint(9) NOT NULL DEFAULT '0', PRIMARY KEY (id)) ENGINE=MyISAM" );

				$stmt = $db->prepare( 'INSERT INTO ' . $tbhtml . ' VALUES
					(' . $news_contents['id'] . ',
					 :bodyhtml,
					 :rule,
					 :content,
					 ' . $news_contents['imgposition'] . ',
					 ' . $news_contents['copyright'] . ',
					 ' . $news_contents['allowed_send'] . ',
					 ' . $news_contents['allowed_print'] . ',
					 ' . $news_contents['allowed_save'] . ',
					 ' . $news_contents['gid'] . '
					 )' );
				$stmt->bindParam( ':bodyhtml', $news_contents['bodyhtml'], PDO::PARAM_STR, strlen( $news_contents['bodyhtml'] ) );
				$stmt->bindParam( ':rule', $news_contents['rule'], PDO::PARAM_STR, strlen( $news_contents['rule'] ) );
				$stmt->bindParam( ':content', $news_contents['content'], PDO::PARAM_STR, strlen( $news_contents['content'] ) );
				$ct_query[] = ( int )$stmt->execute();
		
				foreach( $fids as $fid )
				{
					$ct_query[] = ( int )$db->exec( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_' . $fid . ' SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_genealogy WHERE id=' . $news_contents['id'] );
				}

				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_bodytext VALUES (' . $news_contents['id'] . ', :bodytext, :ruletext, :contenttext )' );
				$stmt->bindParam( ':bodytext', $news_contents['bodytext'], PDO::PARAM_STR, strlen( $news_contents['bodytext'] ) );
				$stmt->bindParam( ':ruletext', $news_contents['ruletext'], PDO::PARAM_STR, strlen( $news_contents['ruletext'] ) );
				$stmt->bindParam( ':contenttext', $news_contents['contenttext'], PDO::PARAM_STR, strlen( $news_contents['contenttext'] ) );
				$ct_query[] = ( int )$stmt->execute();
		
				if( array_sum( $ct_query ) != sizeof( $ct_query ) )
				{
					$error[] = $nv_Lang->getModule('errorsave');
				}
				unset( $ct_query );
				Header("Location: " . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_array_fam[$news_contents['fid']]['alias'] . '/' . $news_contents['alias'] . '/Manager' . $global_config['rewrite_exturl'], true ));
				exit();
			}
			else
			{
				$error[] = $nv_Lang->getModule('errorsave');
			}
		}else{
			
			$news_contents['alias'] = change_alias($news_contents['title']);
			if( $module_config[$module_name]['alias_lower'] ) $news_contents['alias'] = strtolower( $news_contents['alias'] );
			
			$news_contents['userid'] = $user_info['userid'];
			

			if( $news_contents['status'] == 1 and $news_contents['publtime'] > NV_CURRENTTIME )
			{
				$news_contents['status'] = 2;
			}
			$sql =  "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_genealogy SET
					 fid=" . intval( $news_contents['fid'] ) . ",
					 listfid=" . $db->quote(  $news_contents['listfid']) . ",
					 author=" . $db->quote(  $news_contents['author']) . ",
					 patriarch=" . $db->quote(  $news_contents['patriarch']) . ",
					 status=" . intval( $news_contents['status'] ) . ",
					 publtime=" . intval( $news_contents['publtime'] ) . ",
					 exptime=" . intval( $news_contents['exptime'] ) . ",
					 title=" . $db->quote(  $news_contents['title']) . ",
					 alias=" . $db->quote(  $news_contents['alias']) . ",
					 cityid=" . intval( $news_contents['cityid'] ) . ",
					 districtid=" . intval( $news_contents['districtid'] ) . ",
					 wardid=" . intval( $news_contents['wardid'] ) . ",
					 years=" . $db->quote(  $news_contents['years']) . ",
					 full_name=" . $db->quote(  $news_contents['full_name']) . ",
					 telephone=" . $db->quote(  $news_contents['telephone']) . ",
					 email=" . $db->quote(  $news_contents['email']) . ",
					 edittime=" . NV_CURRENTTIME . "
				WHERE id =" . $news_contents['id'];
			
			if( $db->exec( $sql ) )
			{
				if(defined( 'NV_IS_ADMIN' ))
				{
					$user_post= $admin_info['userid'];
				}else{
					$user_post= $user_info['userid'];
				}
				$sql =  "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_" . $news_contents['fid']. " SET
					 fid=" . intval( $news_contents['fid'] ) . ",
					 listfid=" . $db->quote(  $news_contents['listfid']) . ",
					 author=" . $db->quote(  $news_contents['author']) . ",
					 patriarch=" . $db->quote(  $news_contents['patriarch']) . ",
					 status=" . intval( $news_contents['status'] ) . ",
					 publtime=" . intval( $news_contents['publtime'] ) . ",
					 exptime=" . intval( $news_contents['exptime'] ) . ",
					 title=" . $db->quote(  $news_contents['title']) . ",
					 alias=" . $db->quote(  $news_contents['alias']) . ",
					 cityid=" . intval( $news_contents['cityid'] ) . ",
					 districtid=" . intval( $news_contents['districtid'] ) . ",
					 wardid=" . intval( $news_contents['wardid'] ) . ",
					 years=" . $db->quote(  $news_contents['years']) . ",
					 full_name=" . $db->quote(  $news_contents['full_name']) . ",
					 telephone=" . $db->quote(  $news_contents['telephone']) . ",
					 email=" . $db->quote(  $news_contents['email']) . ",
					 edittime=" . NV_CURRENTTIME . "
				WHERE id =" . $news_contents['id'];
				$db->exec( $sql );
				nv_insert_logs( NV_LANG_DATA, $module_name, $nv_Lang->getModule('genealogy_edit'), $news_contents['title'], $news_contents['admin_id'] );
				
				
				$sql =  'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_bodyhtml_' . ceil( $news_contents['id'] / 2000 ) . ' SET
					bodyhtml=' . $db->quote(  $news_contents['bodyhtml'] ) . ',
					rule=' . $db->quote(  $news_contents['rule'] ) . ',
					content=' . $db->quote(  $news_contents['content'] ) . ',
					copyright=' . intval( $news_contents['copyright'] ) . ',
					gid=' . intval( $news_contents['gid'] ) . '
				WHERE id =' . $news_contents['id'] ;

				
				
				$db->exec( $sql );
				$array_fam_old = $post_old['listfid'] ;
				$array_fam_new =  $news_contents['listfid'] ;

				$array_fam_diff = array_diff( $array_fam_old, $array_fam_new );
				foreach( $array_fam_diff as $fid )
				{
					$ct_query[] = $db->exec( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_' . $fid . ' WHERE id = ' . $news_contents['id'] );
				}
				foreach( $array_fam_new as $fid )
				{
					$db->exec( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_' . $fid . ' WHERE id = ' . $news_contents['id'] );
					$ct_query[] = $db->exec( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_' . $fid . ' SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_genealogy WHERE id=' . $news_contents['id'] );
				}

				$sql =  'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_bodytext SET bodytext=' . $db->quote( $news_contents['bodytext'] ) . ', ruletext=' . $db->quote(  $post['ruletext']) . ', contenttext=' . $db->quote(  $post['contenttext'] ) . ' WHERE id =' . $news_contents['id'] ;
				
				
				
				$db->exec( $sql );
				
					Header("Location: " . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_array_fam[$news_contents['fid']]['alias'] . '/' . $news_contents['alias'] . '/Manager' . $global_config['rewrite_exturl'], true ));
					exit();
				
			}
			else
			{
				Header("Location: " . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_array_fam[$news_contents['fid']]['alias'] . '/' . $news_contents['alias'] . '/Manager' . $global_config['rewrite_exturl'], true ));
				exit();
			}
			
		}
	}
	else
	{
		$news_contents = [
            'id' => 0,
            'fid' => 0,
            'wardid' => 0,
            'cityid' => 0,
            'districtid' => 0,
            'admin_id' => (defined('NV_IS_USER')) ? $user_info['userid'] : 0,
            'author' => '',
            'sourceid' => 0,
            'addtime' => NV_CURRENTTIME,
            'edittime' => NV_CURRENTTIME,
            'status' => 0,
            'publtime' => NV_CURRENTTIME,
            'exptime' => 0,
            'archive' => 1,
            'title' => '',
            'alias' => '',
            'hometext' => '',
            'bodytext' => '',
            'rule' => '',
            'content' => '',
            'homeimgfile' => '',
            'homeimgalt' => '',
            'homeimgthumb' => 0,
            'inhome' => 1,
            'allowed_comm' => 4,
            'allowed_rating' => 1,
            'external_link' => 0,
            'hitstotal' => 0,
            'hitscm' => 0,
            'total_rating' => 0,
            'click_rating' => 0,
            'titlesite' => '',
            'description' => '',
            'bodyhtml' => '',
            'keywords' => '',
            'sourcetext' => '',
            'imgposition' => 2,
            'layout_func' => '',
            'copyright' => 0,
            'allowed_send' => 1,
            'allowed_print' => 1,
            'allowed_save' => 1,
            'auto_nav' => 0
        ];
		$list_users = array();
		$array_keyword = array();
		$content_comment = array();
		
		if( defined( 'NV_EDITOR' ) )
		{
			require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
		}
		elseif( ! nv_function_exists( 'nv_aleditor' ) and file_exists( NV_ROOTDIR . '/' . NV_EDITORSDIR . '/ckeditor/ckeditor.js' ) )
		{
			define( 'NV_EDITOR', true );
			define( 'NV_IS_CKEDITOR', true );
			$my_head .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . NV_EDITORSDIR . '/ckeditor/ckeditor.js"></script>';

			function nv_aleditor( $textareaname, $width = '100%', $height = '450px', $val = '', $customtoolbar = '' )
			{
				global  $module_data;
				$return = '<textarea style="width: ' . $width . '; height:' . $height . ';" id="' . $module_data . '_' . $textareaname . '" name="' . $textareaname . '">' . $val . '</textarea>';
				$return .= "<script type=\"text/javascript\">
				CKEDITOR.replace( '" . $module_data . "_" . $textareaname . "', {" . ( ! empty( $customtoolbar ) ? 'toolbar : "' . $customtoolbar . '",' : '' ) . " width: '" . $width . "',height: '" . $height . "',});
				</script>";
				return $return;
			}
		}
		$show_no_image = $module_config[$module_name]['show_no_image'];

		
		
		$base_url_rewrite = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_array_fam[$news_contents['fid']]['alias'] . '/' . $news_contents['alias'] . '/Manager' . $global_config['rewrite_exturl'], true );
		
	}


	$array_mod_title[] = array(
			'title' => $nv_Lang->getModule('manager'),
			'link' => $base_url_rewrite
		);
	$contents = create_genealogy( $news_contents, $list_users, $array_keyword, $content_comment, $data_config );
}


include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
