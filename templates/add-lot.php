<?=$nav?>
<form class="form form--add-lot container form--invalid" action="/add.php" method="POST" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">

    <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
      <label for="<?=$form['lot-name'] ?>"><?=$form['lot-name']['title'] ?></label>
      <input id="<?=$form['lot-name'] ?>" type="text" name="<?=$form['lot-name'] ?>" placeholder="<?=$form['lot-name']['error-message'] ?>" value="<?=htmlspecialchars($lot_name); ?>">

      <span class="form__error"><?=$form['lot-name']['error-message'] ?></span>
    </div>

    <div class="form__item">
      <label for="<?=$form['category'] ?>"><?=$form['category']['title'] ?></label>

      <select id="<?=$form['category'] ?>" name="<?=$form['category'] ?>" required>
        <option><?=$form['category']['option-default'] ?></option>

        <?foreach ($categories as $category => $value) :?>
        <option><?=$value?></option>
        <?endforeach;?>

      </select>
      <span class="form__error"><?=$form['category']['error-message'] ?></span>
    </div>
  </div>
  <div class="form__item form__item--wide">
    <label for="<?=$form['message'] ?>"><?=$form['message']['title'] ?></label>
    <textarea id="message" name="message" placeholder="<?=$form['message']['error-message'] ?>" required><?=htmlspecialchars($message); ?></textarea>
    <span class="form__error">Напишите описание лота</span>
  </div>
  <div class="form__item form__item--file"> <!-- form__item--uploaded -->
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <div class="form__container-three">
    <div class="form__item form__item--small">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" type="number" name="lot-rate" placeholder="0" required value="<?=htmlspecialchars($lot_rate); ?>">
      <span class="form__error">Введите начальную цену</span>
    </div>
    <div class="form__item form__item--small">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot-step" placeholder="0" required value="<?=htmlspecialchars($lot_step); ?>">
      <span class="form__error">Введите шаг ставки</span>
    </div>
    <div class="form__item">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot-date" required>
      <span class="form__error">Введите дату завершения торгов</span>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>
