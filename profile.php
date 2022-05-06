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
                        ?></span><span class="price"></span></div>
                    </div>
                    <?php
                        if($_SESSION["is_coach"] == "1"){
                            echo '<div class="card-details">
                            <h3 class="title">Plavci</h3><div class="plavci-table"></div></div>';
                            
                        }
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

        });

        $.get('php/getSwimmers.php', (result)=>{
            result = JSON.parse(result);
            console.log(result);
        });
    </script>
</body>

</html>