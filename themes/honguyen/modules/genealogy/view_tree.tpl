<!-- BEGIN: tree -->
<li>
	<span {DIRTREE.class} id="iduser_{DIRTREE.id}"><a href="{DIRTREE.link}">{DIRTREE.lev}.{DIRTREE.weight}: {DIRTREE.full_name}</a></span>
	<!-- BEGIN: wife -->
	- <span {WIFE.class} id="iduser_{WIFE.id}"><a href="{WIFE.link}">{WIFE.full_name}</a></span>
	<!-- END: wife -->
	<!-- BEGIN: tree_content -->
	<ul>
		<!-- BEGIN: loop -->
		{TREE_CONTENT} <!-- END: loop -->
	</ul>
	<!-- END: tree_content -->
</li>
<!-- END: tree -->
<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/clsTreeTopDown.css">
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/clsTreeJs-v1.css">
<link type="text/css" href="{NV_BASE_SITEURL}themes/honguyen/css/style.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}themes/honguyen/css/bootstrap.min.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.dialog.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.treeview.css" rel="stylesheet" />
			<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
			<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" />
			<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.treeview.css" rel="stylesheet" />
			<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.treeview.min.js"></script>

 <link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/toastr.min.css">
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/domti.js"></script>
    <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/fsv.js"></script>
    <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/svgpz.js"></script>
    <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/hmer.js"></script>
    <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/lazysizes.min.js"></script>
    <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/lib_base.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery-image-upload-resizer.js"></script>
    <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.ui.position.js"></script>

    <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/toastr.min.js"></script>
    <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/toast-show.js"></script>
<style>

</style>
<script src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.min.js?t=1704958976"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.treeview.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.dialog.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/contextmenu/jquery.contextmenu.r2.js"></script>
<link rel="stylesheet" href="{NV_STATIC_URL}{NV_ASSETS_DIR}/js/jquery/jquery.treeview.css" type="text/css" />
<script src="{NV_STATIC_URL}{NV_ASSETS_DIR}/js/jquery/jquery.cookie.js" type="text/javascript"></script>
<script src="{NV_STATIC_URL}{NV_ASSETS_DIR}/js/jquery/jquery.treeview.min.js" type="text/javascript"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/tree_glx01.js"></script>


<div class="main_cont">


    
    

<!--<div class="btn_ctrl_svg1" style="right: 20px; ">-->
<!--    <img style="" src="/assert/Ionicons/src/share-alt1.svg" alt="">-->
<!--</div>-->

<div onclick="showHelpDgl()" class="btn_ctrl_svg1" style="right: 20px; border: 0px; width: 80px; font-weight: bold; font-size: 15px ">
<!--    <img style="width: 18px; margin-right: 2px" src="/assert/Ionicons/src/help.svg" alt="">-->
    Trợ giúp
</div>

<a href="https://mytree.vn/member">
    <div title="Thành viên" class="btn_ctrl_svg1" style=" top: 50px; left: 15px;; " onclick="">
        <img style="" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/person.svg" alt="">
    </div>
</a>

<div title="Giới hạn cấp xem" class="btn_ctrl_svg1" style="border: 0px;  bottom: 60px; left: 15px; background-color: transparent ">
    <select name="" id="set_limit_tree_level" style=" background-color: white; border-color: #ddd ; color: grey;  ; border-radius: 5px; padding: 4px 3px; max-width: 40px; font-size: small">
        <option value="">-</option>
        <option value="0">0 - Không giới hạn cấp xem</option>

        <option value="1">1 - Giới hạn xem đến cấp 1</option><option value="2">2 - Giới hạn xem đến cấp 2</option><option value="3">3 - Giới hạn xem đến cấp 3</option><option value="4">4 - Giới hạn xem đến cấp 4</option><option value="5">5 - Giới hạn xem đến cấp 5</option><option value="6">6 - Giới hạn xem đến cấp 6</option><option value="7">7 - Giới hạn xem đến cấp 7</option><option value="8">8 - Giới hạn xem đến cấp 8</option><option value="9">9 - Giới hạn xem đến cấp 9</option>

    </select>
</div>

<div title="Thông tin" class="btn_ctrl_svg1" style=" top: 50px; right: 15px;; ">
    <img onclick="clsTreeTopDownCtrl.showInformation()" style="" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/information.svg" alt="">
</div>


<div class="" id="tree_info_" style="display: none; position: fixed; top: 100px; right: 15px;;
 max-width: 300px; border: 1px solid #ccc; background-color: snow; border-radius: 5px; padding: 20px ">
    <div title="Thông tin" id="showInformation_close" style="position: fixed; top: 105px; right: 25px;z-index: 1000;">
        ✖
    </div>
    <div id="tree_info_1">
    </div>
</div>

<div class="btn_ctrl_svg1" style="  left: 15px; " onclick="window.location.reload();">
    <img title="Làm mới" style="" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/refresh.svg" alt="">
</div>
<div class="btn_ctrl_svg1" style="  left: 60px; " onclick="clsTreeTopDownCtrl.center_fit(&#39;svg_grid&#39;)">
    <img title="Thu gọn" style="" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/arrow-shrink.svg" alt="">
</div>

<!--
<div class="btn_ctrl_svg1" style=" left: px; ">
    <img title="Danh sách cây" style="" src="/assert/Ionicons/src/list-ul1.svg" alt="">
</div>

<div class="btn_ctrl_svg1" style=" left: px; ">
<img title="Tạo cây mới" style="" src="/assert/Ionicons/src/plus.svg" alt="">
</div>


-->
<div class="btn_ctrl_svg1" style=" left: 105px; " onclick="clsTreeTopDownCtrl.showConfigTree(&#39;svg_grid&#39;)">
    <img title="Cấu hình" style="" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/ios-gear.svg" alt="">
</div>
<div class="btn_ctrl_svg1" style=" left: 150px; " onclick="clsTreeTopDownCtrl.selectBackGround(&#39;svg_grid&#39;,0)">
    <img title="Chọn khung ảnh thành viên" style="" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/tablet-portrait-outline.svg" alt="">
</div>


<div onclick="clsTreeTopDownCtrl.downloadImagePng(&#39;svg_grid&#39;, &#39;&#39;)" class="btn_ctrl_svg1" style=" left: 195px; ">
    <img title="Tải xuống dạng ảnh" style="" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/android-download.svg" alt="">
</div>


<script>


</script>

    <div id="app_gp" style="">
        <div id="check_error_node" style="display: none"></div>
        <div id="info_svg" style="display: none; float: right; color: red"></div>

        <svg id="svg_grid" class="root_svg" xmlns="http://www.w3.org/2000/svg" style="">
            <defs>
                <filter id="whiteOutlineEffect" color-interpolation-filters="sRGB">
                    <feMorphology in="SourceAlpha" result="MORPH" operator="dilate" radius="1" />
                    <feColorMatrix in="MORPH" result="WHITENED" type="matrix" values="-1 0 0 0 1, 0 -1 0 0 1, 0 0 -1 0 1, 0 0 0 1 0"/>
                    <feMerge>
                        <feMergeNode in="WHITENED"/>
                        <feMergeNode in="SourceGraphic"/>
                    </feMerge>
                </filter>
            </defs>
        </svg>

        <div id="debug_svg" style="display: none; font-size: smaller; color: #eee"></div>
    </div>

    </div>
	</div>
		
<script>
    let disableApiTreeText = 0
</script>

<!--GetCache-->
<script>
    let dataStaticTree = {Treejsons};

    
    disableApiTreeText = "Cây Không thuộc Tài khoản của bạn, nên không thể chỉnh sửa!"</script>

<script>
        let domainUrl = ''
    let tree1 = new clsTreeTopDownCtrl()
    let url
    tree1.apiAdd = domainUrl + '/api/member-tree-mng/add'
    tree1.apiUpdate = domainUrl + '/api/member-tree-mng/update'
    tree1.apiDelete = domainUrl + '/api/member-tree-mng/delete'
    tree1.apiUploadImage = domainUrl + '/api/member-file/upload'
    tree1.apiBearToken = jctool.getCookie('_tglx863516839');
    
            tree1.optEnableMoveBtn = 1
    

        
        //111
        tree1.optDisableApiTreeText = disableApiTreeText;
            tree1.objBannerTop = {"id":90,"name":"\u0110\u1ea1i Gia \u0110\u00ecnh","title":"{DATA.title}","tree_id":2576,"status":null,"image_list":"\/images\/border-banner-bg1\/banner15.png","color_name":"#d512e2","color_title":"#2458ae","fontsize_name":23,"fontsize_title":25,"banner_name_margin_top":45,"banner_name_margin_bottom":0,"banner_title_margin_top":17,"banner_title_margin_bottom":0,"member_background_img":"\/images\/border-frame-img2\/a016.png","member_background_img2":"\/images\/border-frame-img2\/a012.png","banner_width":830,"banner_height":242,"banner_name_bold":"bold","banner_name_italic":null,"banner_title_bold":"bold","banner_title_italic":null,"banner_title_curver":220,"banner_name_curver":270,"banner_text_shadow_name":"text_shadow1","banner_text_shadow_title":"text_shadow1","banner_margin_top":4,"title_before_or_after_name":0};
    if (!tree1.objBannerTop || tree1.objBannerTop.length == 0)
        tree1.initTopBannerEmpty();

    tree1.objBannerTop._image_list = ''
        
    $(function () {
        tree1.widthCell = 120
        tree1.heightCell = 132
        tree1.spaceBetweenCellX = 20
        tree1.spaceBetweenCellY = 50
        tree1.idSvgSelector = 'svg_grid'
        tree1.optShowMarried = 1
        tree1.optShowOnlyMan = 0
        tree1.optDisableApiForTestLocalOnly = 0
        tree1.apiIndex = url
        tree1.optFitViewPortToWindow = 1

                // console.log(" URLSET = ", tree1.apiIndex);

        if (tree1.optDisableApiForTestLocalOnly) {
            url = "data1.php"
            if (jctool.getUrlParam('url1'))
                url = "data2.php"
        }

        if (dataStaticTree) {
            console.log(" dataStaticTree1 ", typeof dataStaticTree);
            console.log(" dataStaticTree ", dataStaticTree);
            tree1.dataAll = dataStaticTree
            // tree1.dataPart = JSON.parse(JSON.stringify(dataStaticTree))
            // tree1.dataPart = dataStaticTree.slice();
            tree1.dataPart = dataStaticTree

            tree1.setPid = '1';
            // jQuery('.loader1').show();

            if (tree1.dataPart && tree1.dataPart.length > 0) {
                tree1.drawTreeSvg()
                tree1.setZoomAble()

                // if (tree1.dataPart.length > 10)
                //     tree1.fit()
                tree1.moveCenterSvgFirstLoad()
            }
            // jQuery('.loader1').hide();
        } else if (0) {
                    }
    })
    </script>

<script>


    $(function () {


    })


</script>


<script>


    </script>


	<style>
	.sidebar-wrapper{
	display:none !important;
	}
	.node_cont:hover .node_edit_btn {
    text-align: center;
    display:none !important;
	}
	</style>

<!-- END: main -->


<div class="pha-ky">
    <div class="pha-ky-one">
				<a href="{DATA.link_main}" > {DATA.title} </a> <a href="{DATA.link_main}" class"btn"> Xem đầy đủ </a>
    </div>
</div>

<div id="module_show_list">

	<br>
	<!-- BEGIN: foldertree -->
	<ul id="foldertree" class="filetree treeview">
		{DATATREE}
	</ul>
	<!-- END: foldertree -->
	
</div>

<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function() {
		$("#foldertree").treeview({
			collapsed: true,
			unique: true,
			persist: "location"
			});
		
	});
	//]]>
</script>






		
	<script>
    let disableApiTreeText = 0
</script>	
<script>
    let dataStaticTree =;   
    disableApiTreeText = "Cây Không thuộc Tài khoản của bạn, nên không thể chỉnh sửa!"</script>


<script>
        let domainUrl = ''
    let tree1 = new clsTreeTopDownCtrl()
    let url
    tree1.apiBearToken = jctool.getCookie('_tglx863516839');
    
            tree1.optEnableMoveBtn = 1
    

    
        //111
    tree1.optDisableApiTreeText = disableApiTreeText;
            tree1.objBannerTop = {"id":90,"name":"\u0110\u1ea1i Gia \u0110\u00ecnh","title":"{DATA.title}","tree_id":2576,"status":null,"image_list":"\/images\/border-banner-bg1\/banner15.png","color_name":"#d512e2","color_title":"#2458ae","fontsize_name":23,"fontsize_title":25,"banner_name_margin_top":45,"banner_name_margin_bottom":0,"banner_title_margin_top":17,"banner_title_margin_bottom":0,"member_background_img":"\/images\/border-frame-img2\/a016.png","member_background_img2":"\/images\/border-frame-img2\/a012.png","banner_width":830,"banner_height":242,"banner_name_bold":"bold","banner_name_italic":null,"banner_title_bold":"bold","banner_title_italic":null,"banner_title_curver":220,"banner_name_curver":270,"banner_text_shadow_name":"text_shadow1","banner_text_shadow_title":"text_shadow1","banner_margin_top":4,"title_before_or_after_name":0};
        if(!tree1.objBannerTop || tree1.objBannerTop.length ==0)
            tree1.initTopBannerEmpty();

    tree1.objBannerTop._image_list = ''
        
    $(function () {
        tree1.widthCell = 80
        tree1.heightCell = 132
        tree1.spaceBetweenCellX = 20
        tree1.spaceBetweenCellY = 50
        tree1.idSvgSelector = 'svg_grid'
        tree1.optShowMarried = 1
        tree1.optShowOnlyMan = 0
        tree1.optDisableApiForTestLocalOnly = 0
        tree1.apiIndex = url
        tree1.optFitViewPortToWindow = 1

                // console.log(" URLSET = ", tree1.apiIndex);

       

        if (dataStaticTree) {
            tree1.dataAll = dataStaticTree
            // tree1.dataPart = JSON.parse(JSON.stringify(dataStaticTree))
            // tree1.dataPart = dataStaticTree.slice();
            tree1.dataPart = dataStaticTree

            tree1.setPid = '1';
            // jQuery('.loader1').show();

            if(tree1.dataPart && tree1.dataPart.length > 0) {
                tree1.drawTreeSvg()
                tree1.setZoomAble()

            // if (tree1.dataPart.length > 10)
            //     tree1.fit()
                tree1.moveCenterSvgFirstLoad()
            }
            // jQuery('.loader1').hide();
        } else if (0) {
                    }
    })
    </script>