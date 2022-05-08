<!DOCTYPE html>
<html>

<head>
    <?php 
        session_start();
        $title = "Nový závod - SwimSys";
        if(isset($_GET["type"]) && $_GET["type"] == "update"){
             $title = "Upravení závodu - SwimSys";
        }
        include "head.php"; 
    ?>
    <style>
        .clean-block.clean-form form {
            border-top: 2px solid #5ea4f3;
            background-color: #fff;
            max-width: 800px;
            margin: auto;
            padding: 40px;
            box-shadow: 0 2px 10px rgb(0 0 0 / 8%);
        }
    </style>
</head>

<body>
    <input type="hidden" id="type" value="<?php 
        
        if(isset($_GET["type"]) && $_GET["type"] == "update"){
             echo "update";
        } else{
            echo "new";
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
             echo "Úprava Závodu";
        } else{
            echo "Nový závod";
        }
        
    ?></h2>
                    <p></p>
                </div>
                <form action="php/updateRace.php<?php 
                
                if(isset($_GET["type"]) && $_GET["type"] == "update"){
                    echo "?type=update";
                }
                
            ?>" method="POST">
            <h6 style="margin-top:30px"><b>Název závodu</b></h6>
                                    <hr>
            <div class="form-group"><input class="form-control" name="name"
                                    type="text" id="name"></div>
                                    <h6 style="margin-top:30px"><b>Adresa</b></h6>
                                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group"><label>Město</label><input class="form-control" name="name"
                                    type="text" id="name"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Ulice</label><input class="form-control" name="surname"
                                    type="text" id="surname"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group"><label>PSČ</label><input class="form-control" name="name"
                                    type="text" id="name"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Číslo popisné</label><input class="form-control" name="surname"
                                    type="text" id="surname"></div>
                        </div>
                    </div>
                    <h6 style="margin-top:30px"><b>Datum a čas</b></h6>
                                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label>Datum startu</label><input class="form-control" name="name"
                                    type="date" id="name"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label>Čas startu</label><input class="form-control" name="surname"
                                    type="time" id="surname"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label>Datum konce</label><input class="form-control" name="name"
                                    type="date" id="name"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label>Čas konce</label><input class="form-control" name="surname"
                                    type="time" id="surname"></div>
                        </div>
                    </div>

                    <h6 style="margin-top:30px"><b>Registrace týmů</b></h6>
                                    <hr>
                    <div class="form-group"><select class="form-control selectpicker" multiple data-live-search="true" title="Nebyl vybrán žádný tým" name="team" id="team"  <?php 
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
    </script>
</body>

</html>