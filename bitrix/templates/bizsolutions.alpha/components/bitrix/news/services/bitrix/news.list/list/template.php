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

$arSection = $arResult['SECTION']['PATH'][0];
?>
<div class="headline">
    <h2><?= $arSection['NAME'] ?></h2>

    <? // View Type Triggers
    if (!empty($arResult['ITEMS'])) { ?>
        <div class="grid-list-icons">
            <a href="<?= $APPLICATION->GetCurPageParam('', array('view')) ?>"<? if ($arParams['COMPONENT_TEMPLATE'] != 'list') { ?> class="current"<? } ?>>
                <i class="fa fa-th"></i>
            </a>
            <a href="<?= $APPLICATION->GetCurPageParam('view=list', array('view')) ?>"<? if ($arParams['COMPONENT_TEMPLATE'] == 'list') { ?> class="current"<? } ?>>
                <i class="fa fa-th-list"></i>
            </a>
        </div>
    <? } ?>
</div>

<? // Section Description
if (!empty($arSection['DESCRIPTION'])) { ?>
    <p class="margin-bottom-20"><?= $arSection['DESCRIPTION'] ?></p>
<? } ?>

<? // Items List
if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $key => $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));

        $oFormUrl = SITE_DIR . 'include/modals/modal.order.php?subject=' . $arItem['ID'];
        ?>
        <div class="row equal-height-columns margin-bottom-40">
            <? if ($arItem['PREVIEW_PICTURE']) { ?>
                <div class="col-sm-4 sm-margin-bottom-20 equal-height-column">
                    <img class="img-responsive" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>" title="<?= $arItem['PREVIEW_PICTURE']['TITLE'] ?>">
                </div>
                <div class="col-sm-8 news-v3 equal-height-column">
            <? } else { ?>
                <div class="col-sm-12 news-v3">
            <? } ?>
                <div class="news-v3-in-sm no-padding">
                    <h2>
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                    </h2>
                    <p><?= $arItem['PREVIEW_TEXT'] ?></p>
                </div>
            </div>

            <div class="col-md-12 text-right news-v3-panel">
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="btn btn-link"><?= GetMessage('ALPHA_ITEM_MORE') ?></a>
                <a href="<?= $oFormUrl ?>" class="btn-u" data-toggle="modal" data-target="#alpha-modal"><?= GetMessage('ALPHA_ITEM_ORDER') ?></a>
            </div>
        </div>
        <?
    }
    // Bottom Pagination
    if ($arParams['DISPLAY_BOTTOM_PAGER']) {
        ?>
        <div class="text-right">
            <?= $arResult['NAV_STRING'] ?>
        </div>
        <?
    }
}