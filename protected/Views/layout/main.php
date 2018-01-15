<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Электронный банк решений</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
  </head>
  <body>  
  	
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">	     
	    	<span class="navbar-brand">Электронный банк решений</span>	      
	    </div>
	
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="<?= Route::createUrl('admin/index') ?>">Главная</a></li>	       
	      </ul>
	      
	      <?php if (isset($_SESSION['isLogin'])):  ?>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="<?= Route::createUrl('admin/logout') ?>"><i class="glyphicon glyphicon-user"></i> Выход (<?= $_SESSION['username'] ?>)</a></li>
	        <!-- li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	          </ul>
	        </li-->
	      </ul>
	      <?php endif; ?>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
  				
  	
  	</nav>
  	
   	<div class="container" style="padding-top: 100px;">   	   
   		<!-- h1><a class=" href="<?= Route::createUrl('admin/index') ?>">Электронный банк решений</a></h1>
   		<hr /-->
   		
   		<?= $content ?>
	   
	    <hr />
	   	<footer class="footer">
	        <p>&copy; 2016 Трусов Олег Алексеевич</p>
	    </footer>
   	</div>   	   	 
  </body>
</html>