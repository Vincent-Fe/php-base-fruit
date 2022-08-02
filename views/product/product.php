<div class="row">

    <div class="col-md-12">
        <a href="home">Retour à la liste</a>
    </div>

    <div class="col-md-12">
        <div class="img-product mb-3 w-50">
            <img src="<?= $product->image ? 'public/images/' . $product->image : 'http://via.placeholder.com/640x360' ?>" class="img-fluid" alt="img produit">
        </div>
        <h3><?= $product->name ?></h3>
        <span class="text-muted">Catégorie : <?= $product->category_name ?></span>
        <p><?= $product->description ?></p>

        <div>
            <a class="btn btn-warning" href="edit&id=<?= $product->id ?>">Modifier</a>
            <a class="btn btn-danger" href="delete&id=<?= $product->id ?>">Supprimer</a>
        </div>

    </div>


</div>