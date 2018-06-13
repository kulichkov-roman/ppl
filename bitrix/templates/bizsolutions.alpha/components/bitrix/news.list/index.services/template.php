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
    <div class="row content-boxes-v2 margin-bottom-30">
        <? foreach ($arResult['ITEMS'] as $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));
            ?>
            <div class="col-md-4 md-margin-bottom-30" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                <h2 class="heading-sm">
                    <? if ($arItem['DISPLAY_PROPERTIES']['BLOCK_LINK']) { ?>
                        <a class="link-bg-icon" href="<?= $arItem['DISPLAY_PROPERTIES']['BLOCK_LINK']['VALUE'] ?>">
                    <? } ?>

                        <? if ($arItem['DISPLAY_PROPERTIES']['BLOCK_ICON']) {
                            $iconColor = '';
                            if ($color = getColorCode($arItem['DISPLAY_PROPERTIES']['BLOCK_COLOR']['VALUE'])) {
                                $iconColor = ' icon-bg-' . $color;
                            } ?>
                            <i class="icon-custom icon-sm rounded-x<?= $iconColor ?> <?= getIconClass($arItem['DISPLAY_PROPERTIES']['BLOCK_ICON']['VALUE']) ?>"></i>
                            <?
                        } ?>
                        <span><?= $arItem['NAME'] ?></span>

                    <? if ($arItem['DISPLAY_PROPERTIES']['BLOCK_LINK']) { ?>
                        </a>
                    <? } ?>
                </h2>
                <? if ($arItem['DISPLAY_PROPERTIES']['BLOCK_TEXT']) {
                    $textPreview = $arItem['DISPLAY_PROPERTIES']['BLOCK_TEXT']['DISPLAY_VALUE'];
                    if ($arParams['PREVIEW_TRUNCATE_LEN'] > 0) {
                        $obParser = new CTextParser;
                        $textPreview = $obParser->html_cut($textPreview, $arParams['PREVIEW_TRUNCATE_LEN']);
                    }
                    ?>
                    <hr class="no-margin margin-bottom-10">
                    <p><?= $textPreview ?></p>
                <? } ?>
            </div>
        <? } ?>
    </div>
    <?
}