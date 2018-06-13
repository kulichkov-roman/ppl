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
    <ul class="nav navbar-nav">
        <?
        $previousLevel = 0;
        foreach ($arResult as $arItem) {
            if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
                echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
            }

            if ($arItem["IS_PARENT"]) {
                if ($arItem["DEPTH_LEVEL"] == 1) {
                    ?>
                    <li class="dropdown<?if ($arItem["SELECTED"]) { ?> active<? } ?>">
                        <a href="<?= $arItem["LINK"] ?>" class="dropdown-toggle" data-toggle="dropdown"><?=$arItem["TEXT"]?></a>
                        <ul class="dropdown-menu">
                    <?
                } else {
                    ?>
                    <li class="dropdown-submenu<?if ($arItem["SELECTED"]) { ?> active<? } ?>">
                        <a href="<?= $arItem["LINK"] ?>"><?=$arItem["TEXT"]?></a>
                        <ul class="dropdown-menu">
                    <?
                }
            } else {
                if ($arItem["SELECTED"]) {
                    ?>
                    <li class="active">
                        <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    </li>
                    <?
                } else {
                    ?>
                    <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                    <?
                }
            }

            $previousLevel = $arItem["DEPTH_LEVEL"];
        }

        if ($previousLevel > 1) {
            echo str_repeat("</ul></li>", ($previousLevel - 1));
        }
        ?>
    </ul>
    <?
}