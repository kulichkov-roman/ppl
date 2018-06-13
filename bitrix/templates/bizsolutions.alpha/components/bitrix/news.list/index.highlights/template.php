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
    ?>
    <div class="row equal-height-columns">
        <? foreach ($arResult['ITEMS'] as $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));

            $blockColor = '';
            if ($color = getColorCode($arItem['DISPLAY_PROPERTIES']['BLOCK_COLOR']['VALUE'])) {
                $blockColor = ' bg-color-' . $color;
            }

            ?>
            <div class="col-sm-4 sm-margin-bottom-20">
                <div class="easy-block-v3 service-or equal-height-column<?= $blockColor ?>" style="height: 160px;" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                    <div class="service-bg"></div>
                    <? if ($arItem['DISPLAY_PROPERTIES']['BLOCK_ICON']) { ?>
                        <i class="<?= getIconClass($arItem['DISPLAY_PROPERTIES']['BLOCK_ICON']['VALUE']) ?>"></i>
                    <? } ?>
                    <div class="inner-faq-b">
                        <h3>
                            <? if ($arItem['DISPLAY_PROPERTIES']['BLOCK_LINK']) { ?>
                                <a href="<?= $arItem['DISPLAY_PROPERTIES']['BLOCK_LINK']['VALUE'] ?>"><?= $arItem['NAME'] ?></a>
                            <? } else { ?>
                                <?= $arItem['NAME'] ?>
                            <? } ?>
                        </h3>
                        <? if ($arItem['DISPLAY_PROPERTIES']['BLOCK_TEXT']) { ?>
                            <p><?= $arItem['DISPLAY_PROPERTIES']['BLOCK_TEXT']['DISPLAY_VALUE'] ?></p>
                        <? } ?>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
    <?
}