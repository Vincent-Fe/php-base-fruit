
<?php if ($_SERVER['REQUEST_URI'] === '/php-base/register') : ?>
<div class="row">
    <div class="col-md-12 mb-5">
        <h2>S'enregistrer</h2>
    </div>
</div>
<form class="w-100" action="" method="POST">
    <div class="mb-3">
        <label for="username">Pseudo</label>
        <input class="form-control" type="text" name="username" id="username" placeholder="Pseudo">
        <?php if ($errors['username']) : ?>
            <span class="text-danger"><?= $errors['username'] ?></span>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="email">Email</label>
        <input class="form-control" type="text" name="email" id="email" placeholder="email">
        <?php if ($errors['email']) : ?>
            <span class="text-danger"><?= $errors['email'] ?></span>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="password">Mot de passe</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe">
        <?php if ($errors['password']) : ?>
            <span class="text-danger"><?= $errors['password'] ?></span>
        <?php endif; ?>
    </div>

    <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'home' ?>" type="button" class="btn btn-secondary">Annuler</a>
    <button class="btn btn-primary">Confirmer</button>

</form>
<?php elseif ($_SERVER['REQUEST_URI'] === '/php-base/login') : ?>
    <div class="row">
        <div class="col-md-12 mb-5">
            <h2>Se connecter</h2>
        </div>
    </div>
    <form class="w-100" action="" method=POST>
        <div class="mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email" placeholder="email">
            <?php if ($errors['email']) : ?>
                <span class="text-danger"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe">
            <?php if ($errors['password']) : ?>
                <span class="text-danger"><?= $errors['password'] ?></span>
            <?php endif; ?>
        </div>

        <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'home' ?>" type="button" class="btn btn-secondary">Annuler</a>
        <button class="btn btn-primary">Se connecter</button>

    </form>
<?php endif ?>