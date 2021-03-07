<div class="navbar">
 <ul>
  <li><a href="index.php">about</a></li>
  <li><a href="discover.php">discover</a></li>
  <?php
   if(isset($_SESSION) && isset($_SESSION['login_user']))  {
    $account = $_SESSION['login_user'];
    echo "<li>&nbsp;<a href=\"profile.php?name=$account\">$account</a></li>&nbsp; ";
    echo "<li><a href=\"logout.php\">logout</a></li> ";
   } else {
   echo "<li><a href=\"register.php\">register</a></li> ";
   echo "<li><a href=\"login.php\">login</a></li> ";
   }
  ?>
 </ul>
</div>