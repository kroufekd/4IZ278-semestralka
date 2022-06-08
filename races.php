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
                            <?php
                                if(isset($_SESSION["id_user"])){
                                    if($_SESSION["is_coach"] == "1"){
                                        echo '<a href="newRace.php" class="btn btn-success">Přidat závod</a>';
                                    }
                                }

                            ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 block-content" id="details-div" style="padding: 40px !important;">

                    </div>
                </div>
            </div>
        </section>
    </main>

    <input type="hidden" id="is_coach" value="<?php
        if(isset($_SESSION["id_user"])){
            echo $_SESSION["is_coach"];
        }
            
    ?>">
    
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Odstranit závod</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Opravdu chcete data odstranit?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
        <button type="button" class="btn btn-danger" onclick="deleteRace(this)" race_id="" id="delete-btn">Odstranit</button>
      </div>
    </div>
  </div>
</div>
        
    </div>
    <?php
    include "footer.php";
    ?>

    <script>
        function deleteRace(e){
            $.post("php/deleteRace.php?id_race="+$(e).attr("race_id"), ()=>{
                location.reload();
            });
        }
        function returnParams(){
            let params = new URLSearchParams(window.location.search)
            if(params.get("id")){
                return "?id="+params.get("id")
            }else{
                return "";
            }
        }
        $(document).ready(function() {

            
            $("#details-div").hide();
            $.get(`php/getCompetitions.php${returnParams()}`, (result) => {
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
                            ${showButtons(race_data)}            
                    `);
//
                    $("#delete-btn").attr("race_id", race_data[0].id_race);
                    $("#details-div").show();
                }); 
            }
            function showButtons(race_data){
                if($("#is_coach").val() == 1){
                    return `<div class="row">
                        <div class="col-sm-6">
                            <a href="newRace.php?type=update&id_race=${race_data[0].id_race}" class="btn btn-primary" style="width: 100%">Upravit závod</a>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" style="width:100%" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                                Odstranit
                            </button>
                        </div>`;
                }else{
                    return "";
                }
                
            }
            function returnList(race_data){
                let s = "";

                for (let i = 0; i < race_data.length; i++) {
                    s += `
                    <li class="list-group-item">
                        <a href="teams.php">
                        ${race_data[i].team_name}
                        </a>
                    </li>
                    `;
                }

                console.log(race_data);
                return s;
            }


        });
    </script>
</body>

</html>