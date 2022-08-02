<div class="row">
    <div class="col-md-12 mb-5">
        <h2><?= $id ? 'Modifier' . $product->name : 'Ajouter un produit' ?></h2>
    </div>
</div>


<form class="w-100" action="<?= $id === '' ?  "create" : "edit&id=$product->id" ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name">Nom du produit</label>
        <input class="form-control" type="text" name="name" id="name" value="<?= $product->name ?? '' ?>">
        <?php if ($error) : ?>
            <span><?= $error ?></span>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="5"><?= $product->description ?? '' ?></textarea>
        <?php if ($error) : ?>
            <span><?= $error ?></span>
        <?php endif; ?>
    </div>

    <?php if ($file) : ?>
        <div class="mb-3">
            <label for="image">Image</label>
            <img src="public/images/<?= $product->image ?>" class="w-25" alt="<?= $product->image ?>">
            <input type="hidden" name="image" id="image" value="<?= $product->image ?? '' ?>">
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="file"><?= $file ? "Changer l'image" : 'Image' ?></label>
        <input class="form-control" type="file" name="file" id="file">
    </div>



    <div class="mb-3">
        <label for="category">Catégorie</label>
        <select class="form-select" name="category" id="category">
            <?php foreach ($categories as $category) : ?>
                <option <?= $productCatId === $category->id ? 'selected' : '' ?> value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'home' ?>" type="button" class="btn btn-secondary">Annuler</a>
    <button class="btn btn-primary">Confirmer</button>

</form>