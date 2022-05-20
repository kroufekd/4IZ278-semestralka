<?php
session_start();
if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $title = "Závody - SwimSys";
    include "head.php";
    ?>
</head>
<style>
    tr {
        cursor: pointer;
    }
</style>

<body>
    <?php
    include "header.php";
    ?>
    <main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Závody</h2>
                    <p></p>
                </div>
                <div class="row">
                    <div class="col-md-12 block-content" style="padding:40px !important" id="table-div">
                        <table id="table-races" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Název</th>
                                    <th>Adresa</th>
                                    <th>Začátek konání</th>
                                    <th>Konec konání</th>
                                </tr>
                            </thead>

                        </table>
                        <div class="row">
                            <div class="col-md-3" style="margin-top:10px">
                                <a href="newRace.php" class="btn btn-success">Přidat závod</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 block-content" id="details-div" style="padding: 40px !important;">

                    </div>
                </div>
            </div>
        </section>
    </main>
    
        
    </div>
    <?php
    include "footer.php";
    ?>

    <script>
        $(document).ready(function() {

            $("#details-div").hide();
            $.get("php/getCompetitions.php", (result) => {
                result = JSON.parse(result);
                console.log(result);

                var table = $('#table-races').DataTable({
                    ordering: true,
                    responsive: true,
                    language: {
                        url: "assets/cs.json"
                    },
                    "data": result,
                    "columns": [{
                            "data": "name"
                        },
                        {
                            "data": "address"
                        },
                        {
                            "data": "start_time"
                        },
                        {
                            "data": "end_time"
                        }
                    ]
                });
                $('#table-races tbody').on('click', 'tr', function() {
                    var data = table.row(this).data();
                    showRaceDetails(data.id_competition);
                });
            })

            function showRaceDetails(id) {
                $.get("php/getRaceData.php?id_race="+id, (race_data)=>{
                    race_data = JSON.parse(race_data);
                    console.log(race_data);
                    $("#table-div").removeClass("col-md-12");
                    $("#table-div").addClass("col-md-8");

                    $("#details-div").html(`
                        <h4>
                            ${race_data[0].race_name}
                        </h4>
                            <small>${race_data[0].start_time} - ${race_data[0].end_time}</small><br>
                            <small>${race_data[0].address}</small>
                            <hr>
                            <b>Přihlášené týmy</b>
                        <ul class="list-group list-group-flush">
                            ${returnList(race_data)}
                        </ul>
                                        <div class="row">
                        <div class="col-sm-6">
                            <a href="newRace.php?type=update&id_race=${race_data[0].id_race}" class="btn btn-primary" style="width: 100%">Upravit závod</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="deleteRace.php?id_race=${race_data[0].id_race}" class="btn btn-danger" style="width: 100%">Odstranit  </a>
                        </div>
                    `);

                   
                    $("#details-div").show();
                }); 
            }
            function returnList(race_data){
                let s = "";

                for (let i = 0; i < race_data.length; i++) {
                    s += `
                    <li class="list-group-item">${race_data[i].team_name}</li>
                    `;
                }

                console.log(race_data);
                return s;
            }


        });
    </script>
</body>

</html>