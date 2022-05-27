s<!DOCTYPE html>
<html>

<head>
<?php 
        session_start();
        $title = "Změna hesla - SwimSys";
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
                    <h2 class="text-info">Změna hesla</h2>
                </div>
                <form action="php/changePasssword.php" method="POST" id="login-form">
                    <div class="form-group"><label for="old_password">Staré heslo</label><input class="form-control item" type="password" id="old_password" name="old_password"></div>
                    <div class="form-group"><label for="new_password">Nové heslo</label><input class="form-control item" type="password" id="new_password" name="new_password"></div>
                    <div class="form-group"><label for="new_password_again">Nové heslo znovu</label><input class="form-control" type="password" id="new_password_again" name="new_password_again"></div>
                    <button class="btn btn-primary btn-block" type="submit">Přihlásit</button>
                    <br>
                    <?php 
                        if(isset($_GET["error"])){
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
                old_password: {
                    required: true
                },
                new_password:{
                    required: true                    
                },                
                new_password_again:{
                    equalTo: "#new_password"                    
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