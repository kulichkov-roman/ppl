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

// Custom Title
if ($arParams['CUSTOM_TITLE_SHOW'] == 'Y') {
    $blockName = !empty($arParams['CUSTOM_TITLE']) ? $arParams['CUSTOM_TITLE'] : GetMessage('ALPHA_DEFAULT_TITLE');
    ?>
    <div class="headline">
        <h2><?= $blockName ?></h2>
    </div>
<?
}

// Menu Items
if (!empty($arResult)) {
    ?>
    <ul class="list-group sidebar-nav-v1" id="sidebar-nav">
    <?
        $previousLevel = 0;
        foreach ($arResult as $key => $arItem) {
            if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
                echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
            }

            $itemClass = '';
            $arCollapse = array(
                'CLASS' => '',
                'ARIA'  => 'false',
            );
            if ($arItem['DEPTH_LEVEL'] == 1) {
                $itemClass .= ' list-group-item';
            }
            if ($arItem['IS_PARENT']) {
                $itemClass .= ' list-toggle';
            }
            if ($arItem['SELECTED']) {
                $itemClass .= ' active';
                $arCollapse = array(
                    'CLASS' => ' in',
                    'ARIA'  => 'true',
                );
            }
            $itemClass = trim($itemClass);

            if ($arItem["IS_PARENT"]) {
                ?>
                <li class="<?= $itemClass ?>">
                    <a href="#collapse-<?= $key ?>" data-toggle="collapse" data-parent="#sidebar-nav" aria-expanded="<?= $arCollapse['ARIA'] ?>"><?=$arItem["TEXT"]?></a>
                    <ul id="collapse-<?= $key ?>" class="collapse<?= $arCollapse['CLASS'] ?>" aria-expanded="<?= $arCollapse['ARIA'] ?>">
                <?
            } else {
                ?>
                <li class="<?= $itemClass ?>">
                    <? if ($arItem['PARAMS']['badge']) {
                        $badgeColor = $arItem['SELECTED'] ? ' badge-white' : ' badge-u';
                        ?>
                        <span class="badge<?= $badgeColor ?>"><?= $arItem['PARAMS']['badge'] ?></span>
                    <? } ?>
                    <a href="<?= $arItem["LINK"] ?>">
                        <? if ($arItem['PARAMS']['icon']) { ?>
                            <i class="<?= $arItem['PARAMS']['icon'] ?>"></i>
                        <? } ?>
                        <?= $arItem["TEXT"] ?>
                    </a>
                </li>
                <?
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