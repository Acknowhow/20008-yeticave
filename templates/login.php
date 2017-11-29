<?=$nav; ?>
<form class="form container" action="/add.php" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email"
             type="text"
             name="email"
             placeholder="Введите e-mail"
             value="">
      <span class="form__error">Введите e-mail</span>
    </div>
    <div class="form__item form__item--last">
      <label for="password">Пароль*</label>
      <input id="password"
             type="text"
             name="password"
             placeholder="Введите пароль"
             value="">
      <span class="form__error">Введите пароль</span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>;