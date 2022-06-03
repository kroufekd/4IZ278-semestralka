<!DOCTYPE html>
<html>

<head>
    <?php 
        session_start();
        $title = "SwimSys";
        include "head.php";
    ?>
</head>

<body>
    <?php
        include "header.php";
    ?>
    <main class="page landing-page">
        <section class="clean-block clean-hero" style="background-image:url(assets/img/bg.webp);color:rgba(9, 162, 255, 0.85);height:100vh">
            <div class="text">
                <h2>SwimSys</h2>
                <p>Webová aplikace na správu plaveckého klubu</p>
                <a href="login.php" class="btn btn-outline-light btn-lg">
                    Přihlásit
                </a>
                
        </section>

    </main>
    <?php 
        include "footer.php"
    ?>
</body>

</html>