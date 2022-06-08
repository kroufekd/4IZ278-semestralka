<?php 
    $s = "";
    if(isset($_SESSION["id_user"])){
        if($_SESSION["is_coach"] == "1"){
            $s .= '<li class="nav-item" role="presentation"><a class="nav-link" href="swimmers.php">plavci</a></li>';
            $s .= '<li class="nav-item" role="presentation"><a class="nav-link" href="teams.php">týmy</a></li>';
            $s .= '<li class="nav-item" role="presentation"><a class="nav-link" href="races.php">závody</a></li>';
        }else{
            $s .= '<li class="nav-item" role="presentation"><a class="nav-link" href="races.php?id='.$_SESSION["id_user"].'">závody</a></li>';
        }
        $s .= '
        
        
        <li class="nav-item" role="presentation"><a class="nav-link" href="profile.php">profil</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="php/logout.php">odhlášení</a></li>';
    }else{
        $s = '<li class="nav-item" role="presentation"><a class="nav-link" href="login.php">přihlášení</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">domů</a></li>';
    }

 echo '<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
 <div class="container"><a class="navbar-brand logo" href="index.php">SwimSys</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
     <div class="collapse navbar-collapse"
         id="navcol-1">
         <ul class="nav navbar-nav ml-auto">
             
             '.$s.'
         </ul>
     </div>
 </div>
</nav>';
?>