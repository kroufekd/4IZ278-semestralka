<!DOCTYPE html>
<html>

<head>
    <?php 
        session_start();
        $title = "Nový tým - SwimSys";
        if(!isset($_SESSION["id_user"])){
            header("Location: index.php");
        }
    
        if($_SESSION["is_coach"] == "0"){
            header("Location: index.php");
        }
        include "head.php"; 
    ?>
</head>

<body>
    <?php
        include "header.php";
    ?>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">
                        Nový tým
                    </h2>
                    <p></p>
                </div>
                <form action="php/newTeam.php" method="POST" id="team-form">
                  
                    <div class="form-group"><label>Název</label><input class="form-control" type="text" name="name"
                            id="name"></div>
                    <div class="form-group"><label>Trenér</label><select class="form-control" name="coach" id="coach"></select></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Vytvořit</button></div>
                </form>
            </div>
        </section>
    </main>
    <?php 
        include "footer.php";
    ?>
    <script>
    


    $.get('php/getCoaches.php', (result) => {
        result = JSON.parse(result);
        console.log(result);
        let s = "";
        for (let i = 0; i < result.length; i++) {
            s += `<option value="${result[i].id_person}">${result[i].name} ${result[i].surname}</option>`;
        }
        $("#coach").html(s);
    });

    $("#team-form").validate({
            rules: {
               
                name:{
                    required: true
                },
                coach:{
                    required: true
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