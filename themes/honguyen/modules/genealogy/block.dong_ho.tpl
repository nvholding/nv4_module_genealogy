<!-- BEGIN: main -->
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/owl.carousel.min.css"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/owl.carousel.min.js"></script>
<div class="section_base" id="block_{BLOCK_ID}">
	<div class="row">
		<div class="col-md-24">
			<div class="table-responsive tab-giapha">
				<table class="tabnkv table table-stripeds table-bordereds table-hover">
					<caption>
						{BLOCK_TITLE}
					</caption>
					<tbody>
					<tr>
					<!-- BEGIN: loopcatid -->
						
						<!-- BEGIN: loop -->
						<!-- BEGIN: looptd -->
						
						<td><a href="{link}" title="{title}">{title}</a></td>
						
						<!-- END: looptd -->
						<!-- END: loop -->
						
						<!-- BEGIN: break -->
						</tr>
						<tr>
						<!-- END: break -->
						
						<!-- END: loopcatid -->
						</tr>
					  
					</tbody>
				</table>
			</div>
			
		</div>
		
	</div>
</div>
<script>
function cartorder_block(a_ob, popup, buy_now, modulename) {
    var num = 1;
    var id = $(a_ob).attr("data-id");
   

    $.ajax({
        type: "POST",
        url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + modulename + '&' + nv_fc_variable + '=setcart' + '&id=' + id + '&nocache=' + new Date().getTime(),
        data: 'num=' + num,
        success: function(data) {
            var s = data.split('_');
            var strText = s[1];
            if (strText != null) {
                var intIndexOfMatch = strText.indexOf('#@#');
                while (intIndexOfMatch != -1) {
                    strText = strText.replace('#@#', '_');
                    intIndexOfMatch = strText.indexOf('#@#');
                }
                alert_msg(strText);
                $("#cart2_" + modulename).load(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + modulename + '&' + nv_fc_variable + '=loadcart2');
                if (buy_now) {
                    parent.location = nv_base_siteurl + "index.php?" + nv_lang_variable + "=" + nv_lang_data + "&" + nv_name_variable + "=" + modulename + "&" + nv_fc_variable + "=cart";
                }  
            }
        }
    });
}
function alert_msg(msg) {
    $('body').removeClass('.msgshow').append('<div class="msgshow" id="msgshow">&nbsp;</div>');
    $('#msgshow').html(msg);
    $('#msgshow').show('slide').delay(3000).hide('slow');
}
</script>
<style>
.productcount .countitem.visible {
    background: #ffcfb4;
}

.productcount .countitem {
    width: 100%;
    height: 15px;
    border-radius: 7px;
    position: relative;
    background: #ff5c01;
    z-index: 1;
    margin-top: 15px;
}
.productcount span {
    font-size: 14px;
    font-family: "Roboto","HelveticaNeue","Helvetica Neue",sans-serif;
    position: absolute;
    top: 0;
    z-index: 4;
    color: #fff;
    line-height: 17px;
    left: 50%;
    transform: translateX(-50%);
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    -os-transform: translateX(-50%);
}
.a-center {
    text-align: center !important;
}
.productcount .countitem.visible .countdown {
    border-top-right-radius: 0px;
    border-bottom-right-radius: 0px;
}

.productcount .countitem .countdown {
    position: absolute;
    height: 15px;
    border-radius: 7px;
    background: #ff5c01;
    z-index: 2;
    left: 0;
    top: 0;
}
.productcount .countitem .countdown span {
    position: relative;
    display: inline-block;
    width: 25px;
    height: 25px;
    z-index: 3;
    background-image: url(//bizweb.dktcdn.net/100/333/138/themes/687589/assets/icon_fire.svg?1579582079595);
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center center;
    left: 100%;
    top: -10px;
}
</style>
<!-- END: main -->