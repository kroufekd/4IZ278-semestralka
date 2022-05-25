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
    <input type="hidden" id="id_race" value="<?php 
        
        if(isset($_GET["type"]) && $_GET["type"] == "update"){
             echo $_GET["id_race"];
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
             echo "Úprava závodu";
        } else{
            echo "Nový závod";
        }
        
    ?></h2>
                    <p></p>
                </div>
                <form action="php/updateRace.php<?php 
                
                if(isset($_GET["type"]) && $_GET["type"] == "update"){
                    echo "?type=update&id_race=".$_GET["id_race"];
                }
                
            ?>" method="POST" id="race-form">
            <h6 style="margin-top:30px"><b>Název závodu</b></h6>
                                    <hr>
            <div class="form-group"><input class="form-control" name="name"
                                    type="text" id="name"></div>
                                    <h6 style="margin-top:30px"><b>Adresa</b></h6>
                                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group"><label>Město</label><input class="form-control" name="city"
                                    type="text" id="city"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Ulice</label><input class="form-control" name="street"
                                    type="text" id="street"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group"><label>PSČ</label><input class="form-control" name="zip"
                                    type="text" id="zip"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Číslo popisné</label><input class="form-control" name="building_number"
                                    type="text" id="building_number"></div>
                        </div>
                    </div>
                    <h6 style="margin-top:30px"><b>Datum a čas</b></h6>
                                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label>Datum startu</label><input class="form-control date" name="start_date"
                                    type="date" id="start_date"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label>Čas startu</label><input class="form-control" name="start_time"
                                    type="time" id="start_time"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label>Datum konce</label><input class="form-control date" name="end_date"
                                    type="date" id="end_date"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label>Čas konce</label><input class="form-control" name="end_time"
                                    type="time" id="end_time"></div>
                        </div>
                    </div>

                    <h6 style="margin-top:30px"><b>Registrace týmů</b></h6>
                                    <hr>
                    <div class="form-group"><select class="form-control selectpicker" multiple data-live-search="false" title="Nebyl vybrán žádný tým" name="team[]" id="team" >

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
        loadTeams();
        if ($("#type").val() == "update") {
            $.get('php/getRaceData.php?id_race=' + $('#id_race').val(), (result) => {
                result = JSON.parse(result);
                console.log(result);
                $("#name").val(result[0].race_name);
                $("#city").val(result[0].city);        
                $("#street").val(result[0].street);
                $("#building_number").val(result[0].building_number);
                $("#zip").val(result[0].zip);
                $("#start_time").val(result[0].st_unformated);
                $("#start_date").val(result[0].sd_unformated);
                $("#end_time").val(result[0].et_unformated);
                $("#end_date").val(result[0].ed_unformated);
                
                let teams = [];

                for (let i = 0; i < result.length; i++) {
                    teams.push(result[i].id_team);
                }
                
                loadTeams(teams);
                //$('.selectpicker').selectpicker('val', [2,4]); 

            });
        }
        function loadTeams(teams){
            $.get('php/getTeams.php', (result) => {
                result = JSON.parse(result);

                let s = "";
                for (let i = 0; i < result.length; i++) {
                    s += `<option value="${result[i].id_team}">${result[i].name}</option>`;
                }
                $("#team").html(s);

                if(teams) $('.selectpicker').selectpicker('val', teams); 
                
            });
        }
        $("#race-form").validate({
            rules: {
                name: {
                    required: true,
                },
                city:{
                    required: true
                },
                street:{
                    required: true
                },
                zip:{
                    required: true,
                    exactlength: 9,
                    number: true
                },
                building_number:{
                    required: true,
                    number: true
                },
                start_date:{
                    required: true,                    
                },
                start_time:{
                    required: true,
                },
                end_date: {
                    required:true
                },                
                end_time: {
                    required:true
                },
                "team[]":{
                    required:true
                }
            },
            errorPlacement: function (error, input) {
                input.css("border-bottom-color", "red");
                error.css("margin-top", "10px");
                error.css('color', 'red');
                
                input.after(error);
            }
        });

    </script>
</body>

</html>