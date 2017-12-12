<?=$nav?>
<form class="form form--add-lot container <?if (!empty($errors)) : ?>form--invalid<? endif; ?>"
      action="/add.php" method="POST" enctype="multipart/form-data">
  <h2>Добавление лота</h2>

  <div class="form__container-two">
    <div class="form__item <?if (!empty($errors['lot'])) : ?>form__item--invalid<? endif; ?>">
      <label for="<?=$lot['name']; ?>"><?=$lot['title']; ?></label>
      <input id="<?=$lot['name']; ?>"
             type="text"
             name="<?=$lot['name']; ?>"
             placeholder="<?=$lot['placeholder']; ?>"
             value="<?=htmlspecialchars($lot['input']); ?>">
      <span class="form__error"><?if (isset($errors['lot']['error_message'])) : ?><?=$errors['lot']['error_message']; ?><? endif; ?></span>
    </div>

    <div class="form__item <?if (!empty($errors['category'])) : ?>form__item--invalid<? endif; ?>">
      <label for="<?=$category['name']; ?>"><?=$category['title']; ?></label>

      <select id="<?=$category['name']; ?>" name="<?=$category['name']; ?>">
        <option><?=$category['input']; ?></option>
        <? foreach ($categories as $category => $value) :?>
        <option><?=$value; ?></option>
        <? endforeach; ?>
      </select>

      <span class="form__error"><?if (isset($errors['category']['error_message'])) : ?><?=$errors['category']['error_message']; ?><? endif; ?></span>
    </div>
  </div>

  <div class="form__item form__item--wide <?if (!empty($errors['description'])) : ?>form__item--invalid<? endif; ?>">

    <label for="<?=$description['name']; ?>"><?=$description['title']; ?></label>
    <textarea id="<?=$description['name']; ?>"
              name="<?=$description['name']; ?>"
              placeholder="<?=$description['placeholder']; ?>"
    ><?=htmlspecialchars($description['input']); ?></textarea>
    <span class="form__error"><?if (isset($errors['description']['error_message'])) : ?><?=$errors['description']['error_message']; ?><? endif; ?></span>
  </div>

  <div class="form__item form__item--file <?if (!empty($errors['file'])) : ?>form__item--invalid<? endif; ?>"> <!-- form__item--uploaded -->
    <label><?=$photo['title']; ?></label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="" width="113" height="113" alt="<?=$photo['alt']; ?>">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" name="<?=$photo['name']; ?>">
      <span class="form_error"><?if (isset($errors['file']['error_message'])) : ?><?=$errors['file']['error_message']; ?><? endif; ?></span>
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>

  <div class="form__container-three">
    <div class="form__item form__item--small <?if (!empty($errors['rate'])) : ?>form__item--invalid<? endif; ?>">
      <label for="<?=$rate['name']; ?>"><?=$rate['title']; ?></label>
      <input id="<?=$rate['name']; ?>"
             type="number"
             name="<?=$rate['name']; ?>"
             placeholder="0"
             step="0.00001"
             value="<?=htmlspecialchars($rate['input']); ?>">
      <span class="form__error"><? if(isset($errors['rate']['error_message'])) : ?><?=$errors['rate']['error_message']; ?><? endif; ?></span>
    </div>

    <div class="form__item form__item--small <?if (!empty($errors['step'])) : ?>form__item--invalid<? endif; ?>">
      <label for="<?=$step['name']; ?>"><?=$step['title']; ?></label>
      <input id="<?=$step['name']; ?>"
             type="number"
             name="<?=$step['name']; ?>"
             placeholder="0"
             step="0.00001"
             value="<?=htmlspecialchars($step['input']); ?>">
      <span class="form__error"><?if (isset($errors['step']['error_message'])) : ?><?=$errors['step']['error_message']; ?><? endif; ?></span>
    </div>

    <div class="form__item <?if (!empty($errors['date_end'])) : ?>form__item--invalid<? endif; ?>">
      <label for="<?=$date_end['name']; ?>"><?=$date_end['title']; ?></label>
      <input class="form__input-date"
             id="<?=$date_end['name']; ?>"
             type="date"
             name="<?=$date_end['name']; ?>"
             value="<?=$date_end['input']; ?>">
      <span class="form__error"><?if (isset($errors['date_end']['error_message'])) : ?><?=$errors['date_end']['error_message']; ?><? endif; ?></span>
    </div>
  </div>
    <input type="hidden" name="lot_add" value="">
  <span class="form__error form__error--bottom"><?if (!empty($errors)) : ?><?=$all['error_message']; ?><? endif; ?></span>
  <button type="submit" class="button">Добавить лот</button>
</form>
