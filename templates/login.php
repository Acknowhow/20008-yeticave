<?=$nav; ?>
<form class="form container <?if (!empty($errors)) : ?>form__invalid<?endif; ?>" action="/add.php" method="post">
    <h2>Вход</h2>
    <div class="form__item <?if (!empty($errors['email'])) : ?>form__item--invalid<?endif; ?>">
      <label for="<?=$email['name']; ?>"><?=$email['title']; ?></label>
      <input id="<?=$email['name']; ?>"
             type="text"
             name="<?=$email['name']; ?>"
             placeholder="<?=$email['placeholder']; ?>"
             value="<?=htmlspecialchars($email['input']); ?>">
      <span class="form__error"><?if (isset($errors['email'])) : ?><?=$errors['email']; ?><?endif; ?></span>
    </div>
    <div class="form__item form__item--last <?if (!empty($errors['password'])) : ?>form__item--invalid<?endif; ?>">
      <label for="<?=$password['name']; ?>"><?=$password['title']; ?></label>
      <input id="<?=$password['name']; ?>"
             type="text"
             name="<?=$password['name']; ?>"
             placeholder="<?=$password['placeholder']; ?>"
             value="<?=htmlspecialchars($password['input']); ?>">
      <span class="form__error"><?if (isset($errors['password'])) : ?><?=$errors['password']; ?><?endif; ?></span>
      <input type="hidden" name="login" value="">
    </div>
    <button type="submit" class="button">Войти</button>
  </form>