<?=$nav; ?>
<form class="form container <?if (!empty($errors_user)) : ?>form__invalid<?endif; ?>" action="/add.php?add_user=true" method="post">
    <h2>Вход</h2>
    <div class="form__item <?if (!empty($errors_user['email'])) : ?>form__item--invalid<?endif; ?>">
      <label for="<?=$email['name']?>"><?=$email['title']; ?></label>
      <input id="<?=$email['name']; ?>"
             type="text"
             name="<?=$email['name']; ?>"
             placeholder="<?=$email['placeholder']; ?>"
             value="<?=htmlspecialchars($email['input_data']); ?>">
      <span class="form__error"><?if (isset($errors_user['email']['message'])) : ?><?=$errors_user['email']['message']; ?><?endif; ?></span>
    </div>
    <div class="form__item form__item--last <?if (!empty($errors_user['password'])) : ?>form__item--invalid<?endif; ?>">
      <label for="<?=$password['name']; ?>"><?=$password['title']; ?></label>
      <input id="<?=$password['name']; ?>"
             type="text"
             name="<?=$password['name']; ?>"
             placeholder="<?=$password['placeholder']; ?>"
             value="<?=htmlspecialchars($password['input_data']); ?>">
      <span class="form__error"><?if (isset($errors_user['password']['message'])) : ?><?=$errors_user['password']['message']; ?><?endif; ?></span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>;