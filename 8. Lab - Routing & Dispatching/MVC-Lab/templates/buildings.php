<?php
$buildings = $app->createBuildings();
?>

<h1>Buildings</h1>

<h3>
    Resources:
    <p>Gold: <?= $buildings->getUser()->getGold(); ?></p>
    <p>Food: <?= $buildings->getUser()->getFood(); ?></p>
</h3>
