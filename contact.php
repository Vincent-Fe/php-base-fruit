<?php
require_once './includes/header.php';

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
$name = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'] ?? "";
}



?>


<div class="form">
    <form action="" method="POST">
        <label for="name">Nom du produit</label>
        <input type="text" name="name" placeholder="Nom">
        <button type="submit">Valider</button>
    </form>
</div>

<div>
    <p>résultat : <?= $name ?></p>
</div>







<?php
require_once './includes/footer.php';

?>