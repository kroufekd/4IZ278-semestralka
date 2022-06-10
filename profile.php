<?php 
    session_start();
    if(!isset($_SESSION["id_user"])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
<?php 
        $title = "Profil - SwimSys";
        include "head.php";
    ?>
</head>

<body>
<?php
        include "header.php";
    ?>
    <main class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Osobní profil</h2>
                    <p></p>
                </div>
                <form>
                    <div class="products">
                        <h3 class="title" id="name"></h3>
                        <div class="item"><span class="price" id="email"></span>
                            <p class="">Email</p>
                            <p class="item-description"></p>
                        </div>
                        <div class="item"><span class="price" id="phone"></span>
                            <p class="">Telefon</p>
                            <p class="item-description"></p>
                        </div>
                        <div class="total"><span>
                            <?php 
                            if($_SESSION["is_coach"] == "1"){
                                echo "Trenér";
                            }else{
                                echo "Plavec";
                            }
                        ?></span><span class="price" id="team"></span></div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-6">
                            <a href="registration.php?type=new" class="btn btn-primary btn-block <?php 
                                if($_SESSION["is_coach"] == "0"){
                                    echo "disabled";
                                }
                            
                            ?>" style="color:white;text-decoration:none;width:100%">
                               Přidat osobu
                            </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="passwordChange.php" class="btn btn-outline-success btn-block" style="width: 100%">Změnit heslo</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-sm-6">
                            <a href="registration.php?type=update" class="btn btn-primary btn-block" style="color:white;text-decoration:none;width:100%">
                               Upravit profil
                            </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="php/logout.php" class="btn btn-outline-danger btn-block" style="width: 100%">Odhlásit se</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-lg-12">
                                
                            <a href="php/oauth/redirect.php" class="btn btn-primary btn-block" style="background-color:#2C2F33; color:white; border:none" id="dc_btn">Propojit účet s Discordem</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    /*
                        if($_SESSION["is_coach"] == "1"){
                            echo '<div class="card-details">
                            <h3 class="title">Plavci</h3><div class="plavci-table"></div></div>';
                            
                        }
                    */

                    ?>
                    
                    
                </form>
            </div>
        </section>
        <input type="hidden" id="id_user" value="<?php echo $_SESSION["id_user"] ?>">
    </main>
   
    <?php
        include "footer.php";
    ?>

<script>
        $.get('php/getPerson.php?id_user=' + $("#id_user").val(), (result)=>{
            result = JSON.parse(result);
            console.log(result);
            $("#name").text(result[0].name + " " + result[0].surname);
            $("#email").text(result[0].email);
            $("#phone").text(result[0].phone);
            $("#team").text(result[0].team_name);

            if(result[0].discord_id != null){
                $("#dc_btn").attr("href", "javascript: void(0)")
                $("#dc_btn").css("text-decoration", "line-through")
            }
        });

        $.get('php/getSwimmers.php', (result)=>{
            result = JSON.parse(result);
            console.log(result);
        });

        checkParams()
        function checkParams(){        
            let params = new URLSearchParams(window.location.search)
            if(params.get("msg") == "success"){
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
                    toastr.success('Heslo bylo úspěšně změněno');    
            }
        }
    </script>
</body>

</html>