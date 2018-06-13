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
    $blockName = !empty($arParams['CUSTOM_NAME']) ? $arParams['CUSTOM_NAME'] : GetMessage('ALPHA_DEFAULT_NAME');
    ?>
    <div class="heading heading-v1 margin-bottom-40">
        <h2><?= $blockName ?></h2>
    </div>
    <div class="owl-clients-v1">
        <? foreach ($arResult['ITEMS'] as $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));
            ?>
            <div class="item text-center" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                <? if ($arItem['DISPLAY_PROPERTIES']['CLIENT_SITE']) { ?>
                    <a href="<?= $arItem['DISPLAY_PROPERTIES']['CLIENT_SITE']['VALUE'] ?>" target="_blank">
                        <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                    </a>
                <? } else { ?>
                    <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                <? } ?>
            </div>
        <? } ?>
    </div>
    <?
}