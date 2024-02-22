<?php

/**
 * @Project NUKEVIET 4.x
* @Author VINADES.,JSC (contact@vinades.vn)
* @Copyright (C) 2014 VINADES., JSC. All rights reserved
* @License GNU/GPL version 2 or any later version
* @Createdate 3/9/2010 23:25
*/
if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (! nv_function_exists('nv_dong_ho')) {

    /**
     * nv_block_config_relates_blocks()
     *
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     *
     */
    function nv_block_config_dong_ho_blocks($module, $data_block)
    {
        global $nv_Cache, $db_config, $site_mods;

        $html = "<tr>";
        $html .= "	<td>Danh sách họ hiển thị trong block</td>";
        $html .= "	<td>";
         $sql = "SELECT fid, title,alias FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . NV_LANG_DATA .  "_" . $site_mods[$module]['module_data'] . "_family WHERE parentid = 0 ORDER BY weight ASC";
		
        $list = $nv_Cache->db($sql, 'fid', $module);
		
        foreach ($list as $l) {
           
			 $html .= '<label><input type="checkbox" name="config_fid[]" value="' . $l['fid'] . '" ' . ((in_array($l['fid'], $data_block['fid'])) ? ' checked="checked"' : '') . '</input>' . $l['title'] . '</label><br />';
			
        } 
		
        $html .= "</td>\n";
        $html .= '<script type="text/javascript">';
        $html .= '	$("select[name=config_blockid]").change(function() {';
        $html .= '		$("input[name=title]").val($("select[name=config_blockid] option:selected").text());';
        $html .= '	});';
        $html .= '</script>';
        $html .= "</tr>";

        $html .= "<tr>";
        $html .= "	<td>" . $lang_block['numrow'] . "</td>";
        $html .= "	<td><input class=\"form-control w100\" type=\"text\" name=\"config_numrow\" size=\"5\" value=\"" . $data_block['numrow'] . "\"/></td>";
        $html .= "</tr>";

        $html .= "<tr>";
        $html .= "	<td>" . $lang_block['cut_num'] . "</td>";
        $html .= "	<td><input class=\"form-control w100\" type=\"text\" name=\"config_cut_num\" size=\"5\" value=\"" . $data_block['cut_num'] . "\"/></td>";
        $html .= "</tr>";

        return $html;
    }

    /**
     * nv_block_config_relates_blocks_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     *
     */
    function nv_block_config_dong_ho_blocks_submit($module)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
		$return['config']['fid'] = $nv_Request->get_array('config_fid', 'post', array());
        $return['config']['numrow'] = $nv_Request->get_int('config_numrow', 'post', 0);
        $return['config']['cut_num'] = $nv_Request->get_int('config_cut_num', 'post', 0);
        return $return;
    }

   
   
	

    /**
     * nv_relates_product()
     *
     * @param mixed $block_config
     * @return
     *
     */
    function nv_dong_ho($block_config)
    {
        global $nv_Cache, $nv_Cache, $site_mods, $global_config, $lang_module, $module_config, $module_config, $module_name, $module_info, $global_array_shops_cat, $db_config, $my_head, $db, $pro_config, $money_config, $array_wishlist_id;

        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $mod_file . '/block.dong_ho.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        if ($module != $module_name) {
		
		
            $sql = 'SELECT fid, parentid, lev, title, alias, viewfam, numsubfam, subfid, numlinks, description, inhome, keywords, groups_view FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . NV_LANG_DATA . '_' . $mod_data . '_family WHERE parentid = 0 ORDER BY weight ASC';
            $list = $nv_Cache->db($sql, 'fid', $module);
            foreach ($list as $row) {
                $global_array_shops_cat[$row['catid']] = array(
                    'catid' => $row['catid'],
                    'parentid' => $row['parentid'],
                    'title' => $row['title'],
                    'alias' => $row['alias'],
                    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $row['alias'],
                    'viewcat' => $row['viewcat'],
                    'numsubcat' => $row['numsubcat'],
                    'subcatid' => $row['subcatid'],
                    'numlinks' => $row['numlinks'],
                    'description' => $row['description'],
                    'inhome' => $row['inhome'],
                    'keywords' => $row['keywords'],
                    'groups_view' => $row['groups_view'],
                    'lev' => $row['lev'],
                );
            }
            unset($list, $row);

        }   

        $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=';

        $xtpl = new XTemplate('block.dong_ho.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file);
        $xtpl->assign('LANG', $lang_module);
		$stt = 1;
		if(!empty($block_config['fid']))
		{
			$i = 1;
			foreach($block_config['fid'] as $bid)
			{
				//print_r($bid);
				 $db->sqlreset()
				->select('fid, title , alias, add_time, image')
				->from($db_config['prefix'] . '_' . NV_LANG_DATA . '_' . $mod_data . '_family')
				->where('fid= ' . $bid . ' AND status =1')
				->order('weight ASC')
				->limit($block_config['numrow']);
			
				$list = $nv_Cache->db($db->sql(), 'fid', $module);
				//print_r($list);die();
				
				$cut_num = $block_config['cut_num'];
				
				
				
				if(!empty($list))
					{
					foreach ($list as $row) {
						if(!empty($row))
						{
							

							$xtpl->assign('id', $row['fid']);
							$xtpl->assign('link', $link . 'dong-ho/' . $row['alias'] . $global_config['rewrite_exturl']);
							$xtpl->assign('title', nv_clean60($row['title'], $cut_num));
							$xtpl->parse('main.loopcatid.loop.looptd');
						}							
						
					}
					$xtpl->parse('main.loopcatid.loop');
					
				}
					
					if($i>=4){
						$xtpl->parse( 'main.loopcatid.break' );
						$i=0;
					}
					$xtpl->parse('main.loopcatid');
					$i++; 
			}
			
		}
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_dong_ho($block_config);
}
