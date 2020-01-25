	<style type="text/css">
		#parent_selector{
			min-width:300px; _width:300px;  position:absolute;display:none; top:0; left:0; border:10px #666 solid; -moz-border-radius:8px; background:#fff; z-index:30; padding:20px;
			}
		.topnav ul{
			margin:0 0 6px 14px;
			}
		.topnav li{
		
			}
	</style>

	<script type="text/javascript">
	<!--
		function select_parent(){
			$("#parent_selector").fadeIn();
			}
		$(function(){
			$("#parent_selector a").click(function(event){
				event.preventDefault();
				var parent = $(this).attr('href');
				$("#parent").val(parent);
				$("#parent_selector").fadeOut();
				});
			});
	//-->
	</script>


	<div id="parent_selector">
		<div class="heading">Select Parent</div>
		<a href="0"><b>No Parent(Root)</b></a><br/><br/>
		<?php echo $parent_selector_menu; ?>
		<br/><br/><br/>
		<div style="text-align:right;"><button onclick="$('#parent_selector').fadeOut();">x Close</button></div>
	</div>