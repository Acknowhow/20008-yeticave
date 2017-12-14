<?=$nav?>
<form class="form container <?if (!empty($errors)) : ?>form_invalid<?endif; ?>" action="/add.php" method="POST" enctype="multipart/form-data">
  <h2>Регистрация нового аккаунта</h2>
  <div class="form__item <?if (!empty($errors['email'])) : ?>form__item--invalid<?endif;?>">
    <label for="<?=$email['name']; ?>"><?=$email['title']; ?></label>
    <input id="<?=$email['name']; ?>"
           type="text"
           name="<?=$email['name']; ?>"
           placeholder="<?=$email['placeholder']; ?>"
           value="<?=htmlspecialchars($email['input']); ?>">
    <span class="form__error"><?if (isset($errors['email'])) : ?><?=$errors['email']; ?><?endif; ?></span>
  </div>

  <div class="form__item <?if (!empty($errors['password'])) : ?>form__item--invalid<?endif; ?>">
    <label for="<?=$password['name']; ?>"><?=$password['title']; ?></label>
    <input id="<?=$password['name']; ?>"
           type="text"
           name="<?=$password['name']; ?>"
           placeholder="<?=$password['placeholder']; ?>"
           value="<?=htmlspecialchars($password['input']); ?>">
    <span class="form__error"><?if (isset($errors['password'])) : ?><?=$errors['password']; ?><?endif; ?></span>
  </div>
  <div class="form__item <?if (!empty($errors['name'])) : ?>form__item--invalid<?endif; ?>">
    <label for="<?=$name['name']; ?>"><?=$name['title']; ?></label>
    <input id="<?=$name['name']; ?>"
           type="text"
           name="<?=$name['name']; ?>"
           placeholder="<?=$name['placeholder']; ?>"
           value="<?=htmlspecialchars($name['input']); ?>">
    <span class="form__error"><?if (isset($errors['name'])) : ?><?=$errors['name']; ?><?endif; ?></span>
  </div>
  <div class="form__item <?if (!empty($errors['contacts'])) : ?>form__item--invalid<?endif; ?>">
    <label for="<?=$contacts['name']; ?>"><?=$contacts['title']; ?></label>
    <textarea id="<?=$contacts['name']; ?>"
              name="<?=$contacts['name']; ?>"
              placeholder="<?=$contacts['placeholder']?>"><?=htmlspecialchars($contacts['input']); ?></textarea>
    <span class="form__error"><?if (isset($errors['contacts'])) : ?><?=$errors['contacts']; ?><?endif; ?></span>
  </div>
  <div class="form__item form__item--file form__item--last">
    <label><?=$url['title']; ?></label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="" width="113" height="113" alt="<?=$url['alt']; ?>">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" value="" name="<?=$url['name']; ?>">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
      <span class="form_error"><?if (isset($errors['file'])) : ?><?=$errors['file']; ?><? endif; ?></span>
    </div>
  </div>
  <input type="hidden" name="register" value="">
  <span class="form__error form__error--bottom"></span>
  <button type="submit" class="button">Зарегистрироваться</button>
  <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
