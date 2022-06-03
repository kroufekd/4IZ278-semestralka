<?php
session_start();
if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
}

if($_SESSION["is_coach"] == "0"){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $title = "Týmy - SwimSys";
    include "head.php";
    ?>
</head>
<style>
    tr {
    
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
                    <h2 class="text-info">Týmy</h2>
                    <p></p>
                </div>
                <div class="row">
                    <div class="col-md-12 block-content" style="padding:40px !important" id="table-div">
                        <table id="table-teams" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Název</th>                                
                                    <th>Trenér</th>
                                </tr>
                            </thead>

                        </table>
                        <div class="row">
                            <div class="col-md-3" style="margin-top:10px">
                                <a href="newTeam.php" class="btn btn-success">Přidat tým</a>
                            </div>
                        </div>
                    </div>   
                    <div class="col-md-4 block-content" id="details-div" style="padding: 40px !important;">

                    </div>             
                </div>
                
            </div>
        </section>
    </main>
    
        <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Odstranit tým</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Opravdu chcete data odstranit?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
        <button type="button" class="btn btn-danger" onclick="deleteTeam(this)" team_id="" id="delete-btn">Odstranit</button>
      </div>
    </div>
  </div>
</div>
    </div>
    <?php
    include "footer.php";
    ?>

    <script>

    function deleteTeam(e){
        $.post("php/deleteTeam.php?id_team="+$(e).attr("team_id"), ()=>{
            
        });
    }

    $("#details-div").hide();

    loadTable();
    function loadTable(){
        $.get(`php/getTeams.php`, (result) => {
            result = JSON.parse(result);
            console.log(result);
            $.get("php/getCoaches.php", (coaches)=>{
                coaches = JSON.parse(coaches);              
                console.log(coaches);     
                var table = $('#table-teams').DataTable({
                    ordering: true,
                    responsive: true,
                    language: {
                        url: "assets/cs.json"
                    },
                    "data": result,
                    "columns": [{
                            "data": "name",

                        },
                        {
                            "data": "id_coach",
                            "width": "35%",
                            render: (id_coach, type, row)=>{
                                let s = "";
                                for (let i = 0; i < coaches.length; i++) {
                                    s+= `
                                        <option value="${coaches[i].id_person}" ${setSelected(id_coach, coaches[i].id_person)}>${coaches[i].name} ${coaches[i].surname}</option>
                                    `                                    
                                }
                                return `
                                    <select class="form-control" value="${id_coach}" onchange="setCoachForTeam(${row.id_team}, this)">${s}</select>
                                `;
                            }                                
                        }
                    ]
            });

            $('#table-teams tbody').on('click', '.sorting_1', function() {
                var data = table.row(this).data();
                console.log(data);
                showTeamDetails(data.id_team);
            }); 

        });                        
    });
    }
    // php/deletePerson.php?id_person=${data}
        
    function showTeamDetails(id){
        $.get("php/getSwimmers.php?id_team="+id, (swimmers)=>{
            swimmers = JSON.parse(swimmers);
            console.log(swimmers);
            $("#table-div").removeClass("col-md-12");
            $("#table-div").addClass("col-md-8");

            $("#details-div").html(`
                <h4>
                    Plavci v týmu
                </h4>
                <hr>
                <ul class="list-group list-group-flush">
                    ${returnList(swimmers)}
                </ul>
                ${deleteIfNoSwimmer(swimmers)}
                
            `);

            $("#delete-btn").attr("team_id", id);
            $("#details-div").show();
        }); 
    }
    function deleteIfNoSwimmer(swimmers){
        if(swimmers.length == 0){
            return `
                        <button type="button" style="width:100%" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter" style="margin-top:2vh">
                            Odstranit tým
                        </button>
                    ` 
        }else{
            return ""
        }
    }
    function returnList(swimmers){
        let s = "";

        for (let i = 0; i < swimmers.length; i++) {
            s += `
            <li class="list-group-item">
            <a href="swimmers.php">
            ${swimmers[i].name} ${swimmers[i].surname}</a>
            </li>
            `;
        }
        if(swimmers.length == 0){
            return '<li class="list-group-item">Tým nemá žádné plavce</li>';
        }else{
            return s;
        }
    }

    function setSelected(x,y){
        if(x==y){
            return `selected="selected"`
        } else{
            return ``;
        }

    }
    function setCoachForTeam(id_team, select){
        $.post(`php/updateCoachForTeam.php?id_team=${id_team}&id_coach=${$(select).val()}`, (result)=>{
            //location.reload();
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
            console.log(result);
            if(result){
                toastr.success('Změny byly úspěšně uloženy.')                        
            }else{
                toastr.error("Změny nebyly uloženy, kontaktuje prosím správce.");
            }
        });
    }
    checkParams2()
    function checkParams2(){
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
        let params = new URLSearchParams(window.location.search);
        if(params.get('success')){
            toastr.success('Změny byly úspěšně uloženy.')    
        }
    }
    </script>
</body>

</html>