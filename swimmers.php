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
    $title = "Plavci - SwimSys";
    include "head.php";
    if(!isset($_SESSION["id_user"])){
        header("Location: index.php");
    }

    if($_SESSION["is_coach"] == "0"){
        header("Location: index.php");
    }
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
                    <h2 class="text-info">Plavci</h2>
                    <p></p>
                </div>
                <div class="row">
                    <div class="col-md-12 block-content" style="padding:40px !important" id="table-div">
                    <label for="teams" class="bold">Filtrovat dle týmů:</label>
                    <select name="teams" class="form-control" style="width:20%" id="teams" onchange="filterTeams(this.value)">
                        <option value="null">Všechny</option>
                    </select>
                    <br>
                        <table id="table-swimmers" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Jméno</th>                                
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Tým</th>
                                    <th>Akce</th>
                                </tr>
                            </thead>

                        </table>
                        <div class="row">
                            <div class="col-md-3" style="margin-top:10px">
                                <a href="newRace.php" class="btn btn-success">Přidat plavce</a>
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="row" style="margin-top:10px">
            
                </div>
            </div>
        </section>
    </main>
    
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
        <button type="button" class="btn btn-danger" onclick="deleteSwimmer(this)" swimmer_id="" id="delete-btn">Odstranit</button>
      </div>
    </div>
  </div>
</div>
    </div>
    <?php
    include "footer.php";
    ?>

    <script>
    
    function deleteSwimmer(e){
        $.post("php/deletePerson.php?id_person="+$(e).attr("swimmer_id"), ()=>{
            location.reload();
        });
    }

    function checkParams(){        
        let params = new URLSearchParams(window.location.search)
        if(params.get("id_team")){
               $("#teams").val(params.get("id_team"));
        }
    }

    $.get('php/getTeams.php', (result) => {
            result = JSON.parse(result);
            let s = "";
            for (let i = 0; i < result.length; i++) {
                s += `<option value="${result[i].id_team}">${result[i].name}</option>`;
            }
            $("#teams").append(s);

            checkParams()
    });
    function filterTeams(id){
        window.location.href = "swimmers.php?id_team="+id;
    }
    function returnParams(){
        let params = new URLSearchParams(window.location.search)
        if(params.get("id_team")){
            return "?id_team="+params.get("id_team")
        }else{
            return "";
        }
    }

    function setDataToModal(id){
        $("#delete-btn").attr("swimmer_id", id);
    }

    loadTable();
    function loadTable(){
        console.log(returnParams())
        $.get(`php/getSwimmers.php${returnParams()}`, (result) => {
            result = JSON.parse(result);
            $.get("php/getTeams.php", (teams)=>{
                teams = JSON.parse(teams);              
                console.log("loading teams");     
                var table = $('#table-swimmers').DataTable({
                    ordering: true,
                    responsive: true,
                    language: {
                        url: "assets/cs.json"
                    },
                    "data": result,
                    "columns": [{
                            "data": "full_name"
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "phone"
                        },
                        {
                            "data": "team",
                            render: (id_team, type, row)=>{
                                let s = "";
                                for (let i = 0; i < teams.length; i++) {
                                    s+= `
                                        <option value="${teams[i].id_team}" ${setSelected(id_team, teams[i].id_team)}>${teams[i].name}</option>
                                    `                                    
                                }
                                return `
                                    <select class="form-control" value="${id_team}" onchange="setTeamForSwimmer(${row.id_person}, this)">${s}</select>
                                `;
                            }                                
                        },
                        {
                            data: "id_person",
                            render: (data)=>{
                                
                                return `                                   
                                    <a href="#" onclick="setDataToModal(${data})" class="fa-solid fa-trash-can" style="color:red" data-toggle="modal" data-target="#exampleModalCenter"></a>                             
                                `;
                                
                            }
                        }
                    ]
                });
                console.log($(".fa-solid").parent());  
            });
        });
    }
    // php/deletePerson.php?id_person=${data}
         
    function setSelected(x,y){
        if(x==y){
            return `selected="selected"`
        } else{
            return ``;
        }

    }
    function setTeamForSwimmer(id_swimmer, select){
        $.post(`php/updateTeamForPerson.php?id_person=${id_swimmer}&id_team=${$(select).val()}`, (result)=>{
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