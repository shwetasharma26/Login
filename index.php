<?php session_start();?>
<?php
   $app_id = "278273698886319";
   $app_secret = "4d86b7577763e139a7a0f0fdbd48373d";
   $my_url = "http://fb.demo.technosoftwares.co.in/";


   
   $code = $_REQUEST["code"];
   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
     $dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'];

  //   echo("<script> top.location.href='" . $dialog_url . "'</script>");



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>

    <!-- Le fav and touch icons -->
	
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">

    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body>

    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">Project name</a>

          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>

    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Login using facebook</h1>
		<table>
		<tr><td>Username : </td> <td><input type="text" name="username"></td></tr>
		<tr><td>Password : </td> <td><input type="text" name="password"></td></tr>
		</table>
        <p><a class="btn">Login</a></p>
		<p><a class="btn primary large" href="<?php echo($dialog_url);?>">Login using Facebook &raquo;</a></p>

      </div>

     

      <footer>
        <p>&copy; TechnoSoftwares</p>

      </footer>

    </div> <!-- /container -->

  </body>
</html>


<?php
     
   }
 
   if($_REQUEST['state'] == $_SESSION['state']) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;

     

     $response = @file_get_contents($token_url);

     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];



     $user = json_decode(file_get_contents($graph_url));

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>

    <!-- Le fav and touch icons -->
	
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">

    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body>

    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">Project name</a>

          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>

    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Logged In</h1>
<h2>Details</h2>
		
        <p>
<?php
     echo("Hello " . $user->name);
echo("<br> Gender:" . $user->gender);
echo("<br> Link :" . $user->link);
echo("<br> Hometown:" . $user->hometown->name);
echo("<br> Location:" . $user->location->name);
?>
</p>


      </div>

     

      <footer>
        <p>&copy; TechnoSoftwares</p>

      </footer>

    </div> <!-- /container -->

  </body>
</html>




<?php
     
   }
   else {
  //   echo("The state does not match. You may be a victim of CSRF.");
   }


 ?>
