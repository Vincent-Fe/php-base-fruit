<form action="<?= isset($id) ? "edit&id=$product->id" : "create" ?>" method="POST">
    <div class="mb-3">
        <label for="name">Nom du produit</label>
        <input class="form-control" type="text" name="name" id="name" value="<?= $product->name ?? '' ?>">
        <?php if ($error) : ?>
            <span><?= $error ?></span>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="10">
            <?= $product->description ?? '' ?>
        </textarea>
        <?php if ($error) : ?>
            <span><?= $error ?></span>
        <?php endif; ?>
    </div>



    <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'home' ?>" type="button" class="btn btn-secondary">Annuler</a>
    <button class="btn btn-primary">Confirmer</button>

</form>