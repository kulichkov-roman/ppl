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

<? // Items Grid
if (!empty($arResult['ITEMS'])) { ?>
    <div class="row news-v1 equal-height-columns">
        <? foreach ($arResult['ITEMS'] as $key => $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));

            $oFormUrl = SITE_DIR . 'include/modals/modal.order.php?subject=' . $arItem['ID'];
            ?>
            <div class="col-md-4">
                <div id="<?= $this->GetEditAreaId($arItem['ID']) ?>" class="news-v1-in margin-bottom-40 equal-height-column">
                    <? if ($arItem['PREVIEW_PICTURE']) { ?>
                        <img class="img-responsive" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>" title="<?= $arItem['PREVIEW_PICTURE']['TITLE'] ?>">
                    <? } ?>
                    <h3>
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                    </h3>
                    <p><?= $arItem['PREVIEW_TEXT'] ?></p>

                    <div class="news-v1-info">
                        <div class="col-xs-6">
                            <div class="row">
                                <a class="btn btn-link btn-block" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= GetMessage('ALPHA_ITEM_MORE') ?></a>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <a href="<?= $oFormUrl ?>" class="btn-u btn-block" data-toggle="modal" data-target="#alpha-modal"><?= GetMessage('ALPHA_ITEM_ORDER') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>

    <? // Bottom Pagination
    if ($arParams['DISPLAY_BOTTOM_PAGER']) {
        ?>
        <div class="text-right">
            <?= $arResult['NAV_STRING'] ?>
        </div>
        <?
    }
}