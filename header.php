<?php 
session_start();
    $s = "";
    if(isset($_SESSION["id_user"])){
        $s = '<li class="nav-item" role="presentation"><a class="nav-link" href="php/logout.php">odhlášení</a></li>';
    }else{
        $s = '<li class="nav-item" role="presentation"><a class="nav-link" href="login.php">přihlášení</a></li>';
    }

 echo '<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
 <div class="container"><a class="navbar-brand logo" href="index.php">SwimSys</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
     <div class="collapse navbar-collapse"
         id="navcol-1">
         <ul class="nav navbar-nav ml-auto">
             <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">domů</a></li>
             '.$s.'
         </ul>
     </div>
 </div>
</nav>';
?>