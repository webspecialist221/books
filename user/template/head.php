<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Books E-Shop User Panel</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/messages.css" />
<!-- <link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'> -->
<!-- jQuery file -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script src="js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(".validate_form").validate();
var $ = jQuery.noConflict();
$(function() {
$('#tabsmenu').tabify();
$(".toggle_container").hide();
$(".trigger").click(function(){
	$(this).toggleClass("active").next().slideToggle("slow");
	return false;
});
});
</script>
</head>
