<link href="style.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<head><title>Login</title></head>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
    <a class="navbar-brand" href="#" style="margin: 30px;"><img style="height: 100px; width: 100px;" src="logo.png" alt=""> <h3>Recommendation</h3></a>
    </div>

    <!-- Login Form -->
    <form action="checkLoginData.php" method="POST">
      <input type="text" require id="email" class="fadeIn second" name="email" placeholder="Votre Numero">
    
      <input type="submit" class="fadeIn fourth" value="consulter">
    </form>

   

  </div>
</div>