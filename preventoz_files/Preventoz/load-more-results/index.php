<?php
include("config.inc.php");

$get_total_rows = 0;
$results = $mysqli->query("SELECT COUNT(*) FROM paginate");
if($results){
	$get_total_rows = $results->fetch_row(); 
}

//break total records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
	<meta charset="utf-8">
	<title>Preventoz Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="assets/css/bootstrap.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
          <![endif]-->
          <link href="assets/css/profile.css" rel="stylesheet">
          <p></p> 
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>Preventoz Profile</title>
          <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
          <script type="text/javascript">
          	$(document).ready(function() {

	var track_click = 0; //track user click on "load more" button, righ now it is 0 click
	
	var total_pages = <?php echo $total_pages; ?>;
	$('#results').load("fetch_pages.php", {'page':track_click}, function() {track_click++;}); //initial data to load

	$(".load_more").click(function (e) { //user clicks on button

		$(this).hide(); //hide load more button on click
		$('.animation_image').show(); //show loading image

		if(track_click <= total_pages) //make sure user clicks are still less than total pages
		{
			//post page number and load returned data into result element
			$.post('fetch_pages.php',{'page': track_click}, function(data) {

				$(".load_more").show(); //bring back load more button
				
				$("#results").append(data); //append data received from server
				
				//scroll page to button element
				$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);
				
				//hide loading image
				$('.animation_image').hide(); //hide loading image once data is received

				track_click++; //user click increment on load button

			}).fail(function(xhr, ajaxOptions, thrownError) { 
				alert(thrownError); //alert any HTTP error
				$(".load_more").show(); //bring back load more button
				$('.animation_image').hide(); //hide loading image once data is received
			});
			
			
			if(track_click >= total_pages-1)
			{
				//reached end of the page yet? disable load button
				$(".load_more").attr("disabled", "disabled");
			}
		}

	});
});
</script>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>



	<div class="col-sm-2"></div>

	<div class="col-sm-8">

		<div class="panel panel-default">
			<div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>Chaithanya</h4></div>
			<div class="panel-body">
				<div class="col-sm-3">
					<img src="assets/img/150x150.gif" class="img-circle pull-left"> <a href="#"></a>
					<div class="clearfix"></div>
				</div><br>
			<p>Alright, I have an admittedly insane idea, but if I don't ask you this it's just, uh, you know, it's gonna haunt me the rest of my life.</p>

			<hr><br><br>
			<form method="post" action="../../form/ckpreventozform.php">
				<div class="input-group">

					<input class="form-control" name="comment" placeholder="Add a comment..." type="text" id="comment">
					<div class="input-group-btn">
					</div>
						<div class="col-sm-2"><input name="add" type="submit" id="add" value="Add New Comment">
				</div></div>
			</form>

			</div>
		</div>











		<div  id="results"></div>

		<div align="center">
			<button class="load_more" id="load_more_button">Load More Comments</button>
			<div class="animation_image" style="display:none;"><img src="ajax-loader.gif"> Loading...</div>	
			<br><br></div>





		</div>

		<script type="text/javascript" src="assets/js/jquery.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle=offcanvas]').click(function() {
					$(this).toggleClass('visible-xs text-center');
					$(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
					$('.row-offcanvas').toggleClass('active');
					$('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
					$('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
					$('#btnShow').toggle();
				});
			});
		</script>




	</body>
	</html>
