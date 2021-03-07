<?php require_once 'onac.php'; ?>
<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE>ONAC</TITLE>
  <link rel="stylesheet" type="text/css" href="data/style/main.css">
 </HEAD>
 <BODY>
  <?php include "data/inc/navbar.inc"; ?>
  <div class="headbar">
   <h3>Welcome to ONAC</h3>
  </div>
  <h3>Open News Aggregator Community</h3>
  <p>ONAC is an experimental, proof of concept, community based, news aggregator</p>
  <hr/>
  <p>
   We do not have a "front page" yet. You are recommended to:
   <ol>
    <li>Visit our <a href="community.php?name=onac">default community</a>, which shares our titular name.</li>
    <li>Visit our <a href="discover.php">community discovery</a> page, where you can view the latest communities that have been created.</li>
   </ol>
   Registration is available following the links in the navigation bar.
  </p>
  <?php include 'data/inc/footer.inc'; ?>
 </BODY>
</HTML>