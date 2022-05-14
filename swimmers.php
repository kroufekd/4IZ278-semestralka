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
      $.get("php/getSwimmers.php", (result) => {
                result = JSON.parse(result);
                console.log(result);

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
                            render: (data)=>{
                                
                                $.get("php/getTeams.php", (result)=>{
                                    result = JSON.parse(result);
                                    let s = "";
                                    for (let i = 0; i < result.length; i++) {
                                        s+= `
                                            <option value="${result.id_team}">${result.name}</option>
                                        `
                                        
                                    }
                                    return `
                                        <select value="${data}">${s}</select>
                                    `;
                                });
                                
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
            })
    </script>
</body>

</html>