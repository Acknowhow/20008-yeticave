<nav class="nav">
  <ul class="nav__list container">
    <?foreach ($categories as $category => $value) :?>
      <li class="nav__item">
        <a href=""><?=$value;?></a>
      </li>
    <?endforeach;?>
  </ul>
</nav>