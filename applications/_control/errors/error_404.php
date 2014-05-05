<!DOCTYPE html>
<head>
	<meta charset = "utf-8" >
	<meta name = "robots" value = "noindex" >
	<meta name="author" content="yoX64" />

	<link href = "<?=base_url()?>/applications/_control/images/favicon.png" rel = "shortcut" >
	<link href = "<?=base_url()?>applications/_control/css/main.css" type = "text/css" rel = "stylesheet" >
	<link href = 'http://fonts.googleapis.com/css?family=Cuprum' rel = "stylesheet" type="text/css" >

	<title>Easy Panel - 404 Page Not Found</title>

	<script type="text/javascript" src = "<?=base_url()?>/applications/_control/js/jquery_1.7.1.min.js"></script>

	<!-- ckeditor -->

	<script type="text/javascript" src = "<?=base_url()?>/applications/_control/js/ckeditor/ckeditor.js"></script>

	<!-- -->

	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/forms/forms.js"></script>
	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/forms/chosen.jquery.min.js"></script>

	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/uploader/plupload.js" ></script>
	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/uploader/plupload.html5.js" ></script>
	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/uploader/plupload.html4.js" ></script>
	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/uploader/jquery.plupload.queue.js "></script>

	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/ui/jquery.tipsy.js" ></script>
	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/ui/jquery.prettyPhoto.js" ></script>
	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/ui/jquery.alerts.js"></script>

	<script type = "text/javascript" src = "<?=base_url()?>/applications/_control/js/frontend_custom.js" ></script>

	<script type = "text/javascript" >

		var base_url 	= '{BASE_URL}';
		var app_url 	= '{APP_URL}';

	</script>

</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Error info area -->
<div class="wrapper">
    <div class="errorPage">
        <h2 class="red errorTitle"><span>Something went wrong here</span></h2>
        <h1>404</h1>
        <span class="bubbles"></span>
        <?php echo  $message; ?>
        <div class="backToDash"><a href="<?=base_url()?>_control.php/dashboard" title="" class="seaBtn button">Back to Dashboard</a></div>
    </div>
</div>

<div id="footer">

			<div class="wrapper">

				<span>
					&copy; Copyright 2013.
					Frontend by <a href="#" target="_blank">Eugene Kopyov</a> and
					backend by <a href="http://www.yox64.com" target="_blank">yoX64</a>
				</span>

			</div><!-- .wrapper -->

		</div><!-- #footer -->

</body>
</html>
