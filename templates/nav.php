<nav class="nav">
  <ul class="nav__list container"><?foreach ($categories as $category => $value) : ?>
    <li class="nav__item">
      <a href="all-lots.html"><?=$value; ?></a>
    </li><?endforeach; ?>
  </ul>
</nav>