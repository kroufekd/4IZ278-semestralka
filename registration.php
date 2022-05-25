<!DOCTYPE html>
<html>

<head>
    <?php 
        session_start();
        $title = "Registrace - SwimSys";
        if(isset($_GET["type"]) && $_GET["type"] == "update"){
             $title = "Upravení profilu - SwimSys";
        }
        include "head.php"; 
    ?>
</head>

<body>
    <input type="hidden" id="type" value="<?php 
        
        if(isset($_GET["type"]) && $_GET["type"] == "update"){
             echo "update";
        } else{
            echo "new";
        }
        
    ?>">
    <input type="hidden" id="id_user" value="<?php 

        if(isset($_SESSION["id_user"])){
             echo $_SESSION["id_user"];
        }
        
    ?>">
    <?php
        include "header.php";
    ?>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info"><?php 
        
        if(isset($_GET["type"]) && $_GET["type"] == "update"){
             echo "Úprava profilu";
        } else{
            echo "Nový uživatel";
        }
        
    ?></h2>
                    <p></p>
                </div>
                <form action="php/updatePerson.php<?php 
                
                if(isset($_GET["type"]) && $_GET["type"] == "update"){
                    echo "?type=update";
                }
                
            ?>" method="POST" id="person-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label>Jméno</label><input class="form-control" name="name"
                                    type="text" id="name"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label>Přijmení</label><input class="form-control" name="surname"
                                    type="text" id="surname"></div>
                        </div>
                    </div>
                    <div class="form-group"><label>Email</label><input class="form-control" type="email" name="email"
                            id="email"></div>
                    <div class="form-group"><label>Telefon</label><input class="form-control" type="text" name="phone"
                            id="phone"></div>
                    <div class="form-group"><label>Role</label><select class="form-control" name="role" id="role" <?php 
                        if(isset($_GET["type"]) && $_GET["type"] == "update"){
                            echo "disabled";
                        }
                    ?>>
                            <option value="0">Plavec</option>
                            <option value="1">Trenér</option>
                        </select></div>
                    <div class="form-group"><label>Tým</label><select class="form-control" name="team" id="team"  <?php 
                        if(isset($_GET["type"]) && $_GET["type"] == "update"){
                            echo "disabled";
                        }
                    ?>>

                        </select></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit"><?php 
                        
                        if(isset($_GET["type"]) && $_GET["type"] == "update"){
                            echo "Upravit";
                        } else{
                            echo "Vytvořit";
                        }
                        
                    ?></button></div>
                </form>
            </div>
        </section>
    </main>
    <?php 
        include "footer.php";
    ?>
    <script>
    if ($("#type").val() == "update") {
        $.get('php/getPerson.php?id_user=' + $('#id_user').val(), (result) => {
            result = JSON.parse(result);
            $("#email").val(result[0].email);
            $("#name").val(result[0].name);
            $("#surname").val(result[0].surname);
            $("#phone").val(result[0].phone);
            $("#role").val(result[0].is_coach);
        });
    }


    $.get('php/getTeams.php', (result) => {
        result = JSON.parse(result);
        console.log(result);
        let s = "";
        for (let i = 0; i < result.length; i++) {
            s += `<option value="${result[i].id_team}">${result[i].name}</option>`;
        }
        $("#team").html(s);
    });

    jQuery.validator.addMethod("exactlength", function(value, element, param) {
    return this.optional(element) || value.length == param;
    }, $.validator.format("Zadené číslo má mít {0} číslic."));

    $("#person-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                name:{
                    required: true
                },
                surname:{
                    required: true
                },
                phone:{
                    required: true,
                    exactlength: 9
                },
                role:{
                    required: true,
                },
                team: {
                    required:true
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