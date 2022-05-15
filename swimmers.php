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
            </div>
        </section>
    </main>
    
        
    </div>
    <?php
    include "footer.php";
    ?>

    <script>
        loadTable();
        function loadTable(){
            $.get("php/getSwimmers.php", (result) => {
                result = JSON.parse(result);
                $.get("php/getTeams.php", (teams)=>{
                    teams = JSON.parse(teams);                   
                    var table = $('#table-swimmers').DataTable({
                        ordering: false,
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
                                        <a href="php/deletePerson.php?id_person=${data}" class="fa-solid fa-trash-can" style="color:black"></a>                             
                                    `;
                                    
                                }
                            }
                        ]
                });  
                });
                           
        });
        }
        
            
            function setSelected(x,y){
                if(x==y){
                    return `selected="selected"`
                } else{
                    return ``;
                }

            }
            function setTeamForSwimmer(id_swimmer, select){
                
                console.log(`php/updateTeamForPerson.php?id_person=${id_swimmer}&id_team=${$(select).val()}`);
                $.post(`php/updateTeamForPerson.php?id_person=${id_swimmer}&id_team=${$(select).val()}`, (result)=>{
                    //location.reload()
                });
            }
    </script>
</body>

</html>