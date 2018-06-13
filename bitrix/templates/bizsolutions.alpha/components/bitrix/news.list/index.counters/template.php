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

if (!empty($arResult['ITEMS'])) {
    $itemsCount = count($arResult['ITEMS']);
    if ($itemsCount > 4) {
        $itemsCount = 4;
    }
    $mdClass = 'col-md-' . floor(12 / $itemsCount);
    ?>
    <div class="parallax-counter-v2 parallaxBg1">
        <div class="container">
            <ul class="row list-row">
                <? foreach ($arResult['ITEMS'] as $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));
                    ?>
                    <li class="<?= $mdClass ?> col-sm-6 col-xs-12 md-margin-bottom-30">
                        <div class="counters rounded" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                            <? if ($arItem['DISPLAY_PROPERTIES']['COUNTER_ICON']) { ?>
                                <i class="<?= getIconClass($arItem['DISPLAY_PROPERTIES']['COUNTER_ICON']['VALUE']) ?>"></i>
                            <? } ?>
                            <span class="bs-counter"><?= $arItem['DISPLAY_PROPERTIES']['COUNTER_NUMBER']['VALUE'] ?></span>
                            <h4><?= $arItem['NAME'] ?></h4>
                        </div>
                    </li>
                <? } ?>
            </ul>
        </div>
    </div>
    <?
}