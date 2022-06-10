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
        <section class="clean-block clean-form dark" style="height:100vh">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Přihlášení</h2>
                </div>
                <form action="php/login.php" method="POST" id="login-form">
                    <div class="form-group"><label for="email">Email</label><input class="form-control item" type="email" id="email" name="email"></div>
                    <div class="form-group"><label for="password">Heslo</label><input class="form-control" type="password" id="password" name="password"></div>
                    <button class="btn btn-primary btn-block" type="submit">Přihlásit</button>
                    <br>
                    
                <a href="php/oauth/init-oauth.php" class="btn btn-primary btn-block" style="background-color:#2C2F33; color:white; border:none">Přihlásit přes Discord</a>
                    
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
        checkParams()
        function checkParams(){        
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2500",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            let params = new URLSearchParams(window.location.search)
            if(params.get("error") == "badpassword"){
                
                    toastr.error('Bylo zadáno špatné heslo.')    
            }
            if(params.get("error") == "bademail"){
                    toastr.error('Účet s takovou emailovou adresou nexistuje.')    
            }
        }
    </script>
</body>

</html>