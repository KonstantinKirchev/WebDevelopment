<?php
    $user = $app->createUserFromInfo();
?>

<h1>Hello, <?= $user->getUsername(); ?> </h1>
<h3>
    Resources:
    <p>Gold: <?= $user->getGold(); ?></p>
    <p>Food: <?= $user->getFood(); ?></p>
</h3>
<div class="menu">
    <a href="buildings.php">Buildings</a>
</div>