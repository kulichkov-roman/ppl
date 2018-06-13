<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (!empty($arResult)) {
    ?>
    <div class="news-v3 bg-color-white margin-bottom-30">
        <ul class="list-inline posted-info">
            <li><?= $arResult['DISPLAY_ACTIVE_FROM'] ?></li>
        </ul>

        <h2><?= $arResult['NAME'] ?></h2>
        <? if (!empty($arResult['DETAIL_PICTURE'])) { ?>
            <div class="col-sm-4">
                <div class="row">
                    <img class="img-responsive full-width inner-img" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['DETAIL_PICTURE']['ALT'] ?>" title="<?= $arResult['DETAIL_PICTURE']['TITLE'] ?>"/>
                </div>
            </div>
        <? } ?>
        <?= $arResult['DETAIL_TEXT'] ?>
    </div>
    <?
}