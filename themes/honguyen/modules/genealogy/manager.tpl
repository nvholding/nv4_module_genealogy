<!-- BEGIN: main -->
			<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.treeview.css" rel="stylesheet" />
			<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.treeview.min.js"></script>
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

<div class="col-md-24">
		
		
	<div class="tab-giapha padding-topbottom">
		<table class="tabnkv col-md-24 table table-stripeds table-bordereds table-hover">
			<caption class="title-gia-pha">
					  Danh sách gia phả bạn quản trị
			</caption>
			<thead class="list-gia-pha main-title">
				<tr><th class="col-md-1">STT</th>
				<th class="col-md-5">Dòng họ</th>
				<th class="col-md-2">Tộc trưởng</th>
				<th class="col-md-1">Số Người</th>
				<th class="col-md-4">Quản lý</th>
			</tr></thead>
			<tbody class="dong-ho">
				<!-- BEGIN: loop -->
					<tr>
						<td>{DATA.weight}</td>
						<td><a title="{DATA.title}" href="{DATA.link}"><b>{DATA.title}</b></a></td>
						<td>{DATA.patriarch}</td>
						<td>{DATA.number}</td>
						<td><a href="{DATA.linkmanager}" >Quản trị gia phả</a> - Xóa</td>
					</tr>
				<!-- END: loop --> 
				
			</tbody>
			<tr class="main-title">
				<td class="col-md-24" colspan="7"><input type="button" value="Thêm gia phả" onclick="creategenealogy(1)"></td>
			</tr>
		</table>
		<div class="clear" style="height: 0px">&nbsp;</div>
	</div>
</div>
<div id="create_genealogy" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<i class="fa fa-spinner fa-spin"></i>
						</div>
						<button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
					</div>
				</div>
			</div>
<style>
	#create_genealogy .modal-dialog{
		width: 850px;
		max-width: 850px;
	}
	.popup-product-detail {
		display: block;
		width: 800px;
		border: 0;
		height:500px;
		overflow: hidden;
	}
	</style>
<!-- END: main -->