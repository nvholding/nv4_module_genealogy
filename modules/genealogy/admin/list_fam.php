<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Holding (ceo@nvholding.vn)
 * @Copyright (C) 2020 NV Holding. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 01/01/2020 00:00
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

if( ! defined( 'NV_IS_AJAX' ) ) die( 'Wrong URL' );

$parentid = $nv_Request->get_int( 'parentid', 'get', 0 );

$contents = nv_show_fam_list( $parentid );

include NV_ROOTDIR . '/includes/header.php';
echo $contents;
include NV_ROOTDIR . '/includes/footer.php';