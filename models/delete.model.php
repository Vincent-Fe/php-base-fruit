<?php

$stmp = $pdo->prepare("DELETE FROM product WHERE id = :id");
$stmp->bindValue(":id", $id);
$stmp->execute();
