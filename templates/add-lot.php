<?=$nav?>
<form class="form form--add-lot container <?if($errors) : ?>form--invalid<?endif; ?>"
      action="/add.php" method="POST" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>

  <div class="form__container-two">
    <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
      <label for="<?=$lot_name['name']; ?>"><?=$lot_name['title']; ?></label>
      <input id="<?=$lot_name['name']; ?>"
             type="text"
             name="<?=$lot_name['name']; ?>"
             placeholder="<?=$lot_name['error-message']; ?>"
             value="<?=htmlspecialchars($lot_name['input-data']); ?>">
      <span class="form__error"><?=$lot_name[$error_empty_key]['error-message']; ?></span>
    </div>

    <div class="form__item">
      <label for="<?=$category['name']; ?>"><?=$category['title']; ?></label>
      <select id="<?=$category['name']; ?>"
              name="<?=$category['name']; ?>" required>
        <option><?=$category['option-default']; ?></option>

        <? foreach ($categories as $category => $value) :?>
        <option><?=$value; ?></option>
        <? endforeach; ?>
      </select>
      <span class="form__error"><?=$category['error-message']; ?></span>
    </div>
  </div>

  <div class="form__item form__item--wide">
    <label for="<?=$message['name']; ?>"><?=$message['title']; ?></label>
    <textarea id="<?=$message['name']; ?>"
              name="<?=$message['name']; ?>"
              placeholder="<?=$message['error-message']; ?>"
              required><?=htmlspecialchars($message['input-data']); ?></textarea>
    <span class="form__error"><?=$message['error-message']; ?></span>
  </div>

  <div class="form__item form__item--file"> <!-- form__item--uploaded -->
    <label><?=$file['name']; ?></label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="">
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
      <label for="<?=$lot_rate['name']; ?>"><?=$lot_rate['title']; ?></label>
      <input id="<?=$lot_rate['name']; ?>"
             type="number"
             name="<?=$lot_rate['name']; ?>"
             placeholder="0"
             required value="<?=htmlspecialchars($lot_rate['input-data']); ?>">
      <span class="form__error"><?=$lot_rate['error-message']; ?></span>
    </div>

    <div class="form__item form__item--small">
      <label for="<?=$lot_step['name']; ?>"><?=$lot_step['title']; ?></label>
      <input id="<?=$lot_step['name']; ?>"
             type="number"
             name="<?=$lot_step['name']; ?>"
             placeholder="0"
             required value="<?=htmlspecialchars($lot_step['input-data']); ?>">
      <span class="form__error"><?=$lot_step['error-message']; ?></span>
    </div>

    <div class="form__item">
      <label for="<?=$lot_date['name']; ?>"><?=$lot_date['title']; ?></label>
      <input class="form__input-date"
             id="<?=$lot_date['name']; ?>"
             type="date"
             name="<?=$lot_date['name']; ?>" required>
      <span class="form__error"><?=$lot_date['error-message']; ?></span>
    </div>
  </div>

  <span class="form__error form__error--bottom"><?=$all['error-message']; ?></span>
  <button type="submit" class="button">Добавить лот</button>
</form>
