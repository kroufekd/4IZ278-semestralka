s<!DOCTYPE html>
<html>

<head>
<?php 
        session_start();
        $title = "Přihlášení - SwimSys";
        include "head.php";
    ?>
</head>

<body>
<?php
        include "header.php";
    ?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Přihlášení</h2>
                </div>
                <form action="php/login.php" method="POST" id="login-form">
                    <div class="form-group"><label for="email">Email</label><input class="form-control item" type="email" id="email" name="email"></div>
                    <div class="form-group"><label for="password">Heslo</label><input class="form-control" type="password" id="password" name="password"></div>
                    <button class="btn btn-primary btn-block" type="submit">Přihlásit</button>
                    <br>
                    <?php 
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "bademail"){
                                echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 0;">
                                Účet s takovou emailovou adresou nexistuje.
                                </div>';
                            }
                            if($_GET["error"] == "badpassword"){
                                echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 0;">
                                Zadané špatné heslo.
                                </div>';
                            }
                        }
                    ?>
                    
                </form>
            </div>
        </section>
    </main>

    

    <?php 
        include "footer.php";
    ?>
    <script>
        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password:{
                    required: true,
                    
                }
            },
            errorPlacement: function (error, input) {
                console.log(error);
                input.css("border-bottom-color", "red");
                error.css("margin-top", "10px");
                error.css('color', 'red');
                if (input.attr("type") == "checkbox") {

                } else {

                    input.after(error);
                }            
            }
        });
    </script>
</body>

</html>