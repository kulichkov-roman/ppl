<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
    <ul class="list-unstyled link-list">
        <?
        foreach ($arResult as $arItem) {
            if ($arItem["SELECTED"]) {
                ?>
                <li class="active">
                    <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <?
            } else {
                ?>
                <li>
                    <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <?
            }
        }
        ?>
    </ul>
    <?
}