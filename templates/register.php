<?=$nav?>
<form class="form container <?if (!empty($errors_register)) : ?>form_invalid<?endif; ?>" action="/add.php" method="post">
  <h2>Регистрация нового аккаунта</h2>
  <div class="form__item <?if (!empty($errors_register['email'])) : ?>form__item--invalid<?endif;?>">
    <label for="<?=$email['name']; ?>"><?=$email['title']; ?></label>
    <input id="<?=$email['name']; ?>"
           type="text"
           name="<?=$email['name']; ?>"
           placeholder="<?=$email['placeholder']; ?>"
           value="<?=htmlspecialchars($email['input_data']); ?>">
    <span class="form__error"><?if (isset($errors_register['email']['error_message'])) : ?><?=$errors_register['email']['error_message']; ?><?endif; ?></span>
  </div>

  <div class="form__item <?if (!empty($errors_register['password'])) : ?>form__item--invalid<?endif; ?>">
    <label for="<?=$password['name']; ?>"><?=$password['title']; ?></label>
    <input id="<?=$password['name']; ?>"
           type="text"
           name="<?=$password['name']; ?>"
           placeholder="<?=$password['placeholder']; ?>"
           value="<?=htmlspecialchars($password['input_data']); ?>">
    <span class="form__error"><?if (isset($errors_register['password']['error_message'])) : ?><?=$errors_register['password']['error_message']; ?><?endif; ?></span>
  </div>

  <div class="form__item">
    <label for="name">Имя*</label>
    <input id="name" type="text" name="name" placeholder="Введите имя">
    <span class="form__error">Введите имя</span>
  </div>
  <div class="form__item">
    <label for="message">Контактные данные*</label>
    <textarea id="message" name="message" placeholder="Напишите как с вами связаться"></textarea>
    <span class="form__error">Напишите как с вами связаться</span>
  </div>
  <div class="form__item form__item--file form__item--last">
    <label>Аватар</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <input type="hidden" name="register" value="">
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Зарегистрироваться</button>
  <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
