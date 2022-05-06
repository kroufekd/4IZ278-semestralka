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
    tr{
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
                <div class="block-content">
                    <!--<div class="clean-blog-post">
                        <div class="row">
                            <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/tech/image4.jpg"></div>
                            <div class="col-lg-7">
                                <h3>Lorem Ipsum dolor sit amet</h3>
                                <div class="info"><span class="text-muted">Jan 16, 2018 by&nbsp;<a href="#">John Smith</a></span></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis
                                    vitae leo.</p><button class="btn btn-outline-primary btn-sm" type="button">Read More</button></div>
                        </div>
                    </div>-->
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
                </div>
            </div>
        </section>
    </main>
    <?php
        include "footer.php";
    ?>

    <script>
        $(document).ready(function() {

            $.get("php/getCompetitions.php", (result)=>{
                result = JSON.parse(result);
                console.log(result);

                var table = $('#table-races').DataTable({
                ordering: false,
                language:{
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
            $('#table-races tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
                console.log(data);
                window.location.replace("race_profile.php?id_competition="+data.id_competition);
            });
            })


            
        });
    </script>
</body>

</html>