<div class="row">
    <div class="col-md-12 text-center mb-5">
        <h2>Listes de produit</h2>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <ul class="d-flex justify-content-evenly align-items-center">
            <a type="button" class="text-decoration-none text-muted" href="home">Tous les produits</a>
            <?php foreach ($categories as $category) : ?>
                <form action="home" method="POST">
                    <input type="hidden" name="category_id" value="<?= $category->id ?? '' ?>">
                    <button class="btn btn-link text-decoration-none text-muted" type="submit"><?= $category->name ?></button>
                </form>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


<?php if ($filteredByCategory) : ?>
    <div class="row">
        <div class="col-md-12 d-flex flex-wrap m-3">
            <?php foreach ($filteredByCategory as $product) : ?>
                <a class="m-2 text-decoration-none text-reset" href="product&id=<?= $product->id ?>">
                    <div class="card" style="width: 18rem;">
                        <div class="w-100">
                            <img src="<?= $product->image ? 'public/images/' . $product->image : 'http://via.placeholder.com/640x360' ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $product->name ?></h5>
                            <span class="text-muted">Catégorie : <?= $product->category_name ?></span>

                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col-md-12 d-flex flex-wrap m-3">
            <?php foreach ($products as $product) : ?>
                <a class="m-2 text-decoration-none text-reset" href="product&id=<?= $product->id ?>">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= $product->image ? 'public/images/' . $product->image : 'http://via.placeholder.com/640x360' ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product->name ?></h5>
                            <span class="text-muted">Catégorie : <?= $product->category_name ?></span>

                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>