<?=$nav; ?>
<form class="form container <?if (!empty($errors)) : ?>form__invalid<?endif; ?>" action="/add.php" method="post">
    <h2>Вход</h2>
    <div class="form__item <?if (!empty($errors['email'])) : ?>form__item--invalid<?endif; ?>">
      <label for="<?=$email; ?>"><?=$email['title']; ?></label>
      <input id="<?=$email; ?>"
             type="text"
             name="<?=$email; ?>"
             placeholder="<?=$email['placeholder']; ?>"
             value="<?=htmlspecialchars($email['input']); ?>">
      <span class="form__error"><?if (isset($errors['email']['error_message'])) : ?><?=$errors['email']['error_message']; ?><?endif; ?></span>
    </div>
    <div class="form__item form__item--last <?if (!empty($errors['password'])) : ?>form__item--invalid<?endif; ?>">
      <label for="<?=$password; ?>"><?=$password['title']; ?></label>
      <input id="<?=$password; ?>"
             type="text"
             name="<?=$password; ?>"
             placeholder="<?=$password['placeholder']; ?>"
             value="<?=htmlspecialchars($password['input']); ?>">
      <span class="form__error"><?if (isset($errors['password']['error_message'])) : ?><?=$errors['password']['error_message']; ?><?endif; ?></span>
      <input type="hidden" name="login" value="">
    </div>
    <button type="submit" class="button">Войти</button>
  </form>