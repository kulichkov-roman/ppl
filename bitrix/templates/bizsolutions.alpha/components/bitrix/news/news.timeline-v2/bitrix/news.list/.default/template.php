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
    <div class="row">
        <!-- Begin Content -->
        <div class="col-md-12">
            <? if ($arParams['DISPLAY_TOP_PAGER']) { ?>
                <div class="text-right">
                    <?= $arResult['NAV_STRING'] ?>
                </div>
            <? } ?>

            <ul class="timeline-v2">
                <? foreach ($arResult['ITEMS'] as $key => $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));
                    ?>

                    <li id="<?= $this->GetEditAreaId($arItem['ID']) ?>" class="equal-height-columns">
                        <div class="cbp_tmtime equal-height-column">
                            <span>
                                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                    <?= $arItem['DISPLAY_ACTIVE_FROM'] ?>
                                </a>
                            </span>
                        </div>
                        <i class="cbp_tmicon rounded-x hidden-xs"></i>
                        <div class="cbp_tmlabel equal-height-column">
                            <h2>
                                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                    <?= $arItem['NAME'] ?>
                                </a>
                            </h2>
                            <? if (!empty($arItem['PREVIEW_PICTURE'])) { ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img class="img-responsive" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>" title="<?= $arItem['PREVIEW_PICTURE']['TITLE'] ?>"/>
                                        <div class="md-margin-bottom-20"></div>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-justify">
                                            <?= $arItem['PREVIEW_TEXT'] ?>
                                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= GetMessage('ALPHA_SHOW_MORE') ?></a>
                                        </p>
                                    </div>
                                </div>
                            <? } else { ?>
                                <p class="text-justify">
                                    <?= $arItem['PREVIEW_TEXT'] ?>
                                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= GetMessage('ALPHA_SHOW_MORE') ?></a>
                                </p>
                            <? } ?>
                        </div>
                    </li>
                <? } ?>
            </ul>

            <? if ($arParams['DISPLAY_BOTTOM_PAGER']) { ?>
                <div class="text-right">
                    <?= $arResult['NAV_STRING'] ?>
                </div>
            <? } ?>
        </div>
        <!-- End Content -->
    </div>
    <?
}