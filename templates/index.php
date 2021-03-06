<section class="promo">
  <h2 class="promo__title">Нужен стафф для катки?</h2>
  <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
  <ul class="promo__list"><? foreach ($categories as $title => $name) : ?>
      <li class="promo__item promo__item--<?=$title; ?>">
        <a class="promo__link" href="all-lots.html"><?=$name; ?></a>
      </li>
    <? endforeach; ?>
  </ul>
</section>
<section class="lots">
  <div class="lots__header">
    <h2>Открытые лоты</h2>
  </div>
  <ul class="lots__list">
    <? if (empty($lots)) : ?><h3>На данный момент нет открытых лотов</h3><? else : ?>
    <? foreach ($lots as $lot => $value) :?>
      <li class="lots__item lot">
      <div class="lot__image">
        <img src="<?=$value['url']; ?>" width="350" height="260" alt="<?=$value['alt']; ?>">
      </div>
      <div class="lot__info">
        <span class="lot__category"><?=$value['category']; ?></span>
        <h3 class="lot__title"><a class="text-link" href="index.php?id=<?=$lot; ?>"><?=$value['name']; ?></a></h3>
        <div class="lot__state">
          <div class="lot__rate">
            <span class="lot__amount">Стартовая цена</span>
            <span class="lot__cost"><?=$value['rate']; ?><b class="rub">р</b></span>
          </div>
          <div class="lot__timer timer">
            <?=convertTimeStamp(convertTimeStampMySQL($value['date_end'], false)); ?>
          </div>
        </div>
      </div>
      </li><? endforeach; ?><? endif; ?>
  </ul>
</section>