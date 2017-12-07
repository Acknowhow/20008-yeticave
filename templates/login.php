<?=$nav; ?>
<form class="form container <?if (!empty($errors_login)) : ?>form__invalid<?endif; ?>" action="/add.php" method="post">
    <h2>Вход</h2>
    <div class="form__item <?if (!empty($errors_login['email'])) : ?>form__item--invalid<?endif; ?>">
      <label for="<?=$email['name']?>"><?=$email['title']; ?></label>
      <input id="<?=$email['name']; ?>"
             type="text"
             name="<?=$email['name']; ?>"
             placeholder="<?=$email['placeholder']; ?>"
             value="<?=htmlspecialchars($email['input_data']); ?>">
      <span class="form__error"><?if (isset($errors_login['email']['error_message'])) : ?><?=$errors_login['email']['error_message']; ?><?endif; ?></span>
    </div>
    <div class="form__item form__item--last <?if (!empty($errors_login['password'])) : ?>form__item--invalid<?endif; ?>">
      <label for="<?=$password['name']; ?>"><?=$password['title']; ?></label>
      <input id="<?=$password['name']; ?>"
             type="text"
             name="<?=$password['name']; ?>"
             placeholder="<?=$password['placeholder']; ?>"
             value="<?=htmlspecialchars($password['input_data']); ?>">
      <span class="form__error"><?if (isset($errors_login['password']['error_message'])) : ?><?=$errors_login['password']['error_message']; ?><?endif; ?></span>
      <input type="hidden" name="login" value="">
    </div>
    <button type="submit" class="button">Войти</button>
  </form>