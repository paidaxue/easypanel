<!DOCTYPE html>
  <head>
    <title>Easy Panel - 404 Page Not Found</title>

  	<meta charset="utf-8">
  	<meta name="robots" value="noindex">
  	<meta name="author" content="Microdevt">

  	<link href = "<?=base_url()?>/applications/_control/images/favicon.png" rel = "shortcut" >
  	<link href = "<?=base_url()?>applications/_control/css/main.css" type = "text/css" rel = "stylesheet" >
  	<link href = 'http://fonts.googleapis.com/css?family=Cuprum' rel = "stylesheet" type="text/css" >
  </head>

  <body>
    <div class="wrapper">
      <div class="errorPage">
        <h2 class="red errorTitle"><span>Something went wrong here</span></h2>
        <h1>404</h1>
        <span class="bubbles"></span>
        <?php echo  $message; ?>
        <div class="backToDash">
          <a href="<?=base_url()?>_control.php/dashboard" title="Dashboard" class="seaBtn button">Back to Dashboard</a>
        </div>
      </div>
    </div>
  </body>
</html>
