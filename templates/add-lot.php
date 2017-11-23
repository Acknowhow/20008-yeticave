<?=$nav?>
<form class="form form--add-lot container form--invalid" action="/add.php" method="POST" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">

    <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
      <label for="<?=$lot_name['name'] ?>"><?=$lot_name['title'] ?></label>

      <input id="<?=$lot_name['name'] ?>" type="text" name="<?=$lot_name['name'] ?>"
             placeholder="<?=$lot_name['error-message'] ?>"

             value="<?=htmlspecialchars($lot_name['input-data']); ?>">
      <span class="form__error"><?=$lot_name['error-message'] ?></span>
    </div>

    <div class="form__item">
      <label for="<?=$category_name['name'] ?>"><?=$category_name['title'] ?></label>

      <select id="<?=$category_name['name'] ?>" name="<?=$category_name['name']?>" required>
        <option><?=$category_name['option-default'] ?></option>

        <?foreach ($categories as $category => $value) :?>
        <option><?=$value?></option>
        <?endforeach;?>

      </select>
      <span class="form__error"><?=$category_name['error-message'] ?></span>
    </div>
  </div>
  <div class="form__item form__item--wide">
    <label for="<?=$message['name'] ?>"><?=$message['title'] ?></label>

    <textarea id="<?=$message['name'] ?>" name="<?=$message['name'] ?>"
              placeholder="<?=$message['error-message'] ?>" required>
      <?=htmlspecialchars($message['input-data']); ?>
    </textarea>

    <span class="form__error"><?=$message['error-message'] ?></span>
  </div>
  <div class="form__item form__item--file"> <!-- form__item--uploaded -->
    <label><?=$file['title'] ?></label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="<?=$file['alt'] ?>">
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

      <label for="<?=$lot_rate; ?>"><?=$lot_rate['title'] ?></label>
      <input id="<?=$lot_rate ?>" type="number" name="<?=$lot_rate ?>"

             placeholder="0" required value="<?=htmlspecialchars($lot_rate['input-data']); ?>">
      <span class="form__error"><?=$lot_rate['error-message'] ?></span>
    </div>
    <div class="form__item form__item--small">

      <label for="<?=$lot_step ?>"><?=$lot_step['error-message'] ?></label>
      <input id="<?=$lot_step ?>" type="number" name="<?=$lot_step ?>" placeholder="0"
             required value="<?=htmlspecialchars($lot_step['input-data']); ?>">
      <span class="form__error"><?=$lot_step['error-message'] ?></span>
    </div>
    <div class="form__item">

      <label for="<?=$lot_date ?>"><?=$lot_date['title'] ?></label>
      <input class="form__input-date" id="<?=$lot_date ?>" type="date"
             name="<?=$lot_date ?>" required>
      <span class="form__error"><?=$lot_date['error-message'] ?></span>
    </div>
  </div>

  <span class="form__error form__error--bottom"><?=$all['error-message'] ?></span>
  <button type="submit" class="button">Добавить лот</button>
</form>
