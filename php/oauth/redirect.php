<?php 
    $discord_url = "https://discord.com/api/oauth2/authorize?client_id=981887734694178836&redirect_uri=http%3A%2F%2Flocalhost%2Fskola%2F4iz278-semestralka%2Fphp%2Foauth%2Flink-existing.php&response_type=code&scope=identify%20email";

    header("Location: $discord_url");
    exit();
?>