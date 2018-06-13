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

// Custom Title
if ($arParams['CUSTOM_TITLE_SHOW'] == 'Y') {
    $blockName = !empty($arParams['CUSTOM_TITLE']) ? $arParams['CUSTOM_TITLE'] : GetMessage('ALPHA_DEFAULT_TITLE');
    ?>
    <div class="headline">
        <h2><?= $blockName ?></h2>
    </div>
    <?
}

if (!empty($arResult['ITEMS'])) {
    // Content
    foreach ($arResult['ITEMS'] as $key => $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));
        ?>
        <div class="row clients-page<? if ($key == 0) { ?> first<? } ?>" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
            <div class="col-md-2">
                <img class="img-responsive hover-effect" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>" />
            </div>
            <div class="col-md-10">
                <h3><?= $arItem['NAME'] ?></h3>
                <ul class="list-inline">
                    <? if ($arItem['DISPLAY_PROPERTIES']['CLIENT_PLACE']) { ?>
                        <li>
                            <i class="fa fa-map-marker color-green"></i>
                            <?= $arItem['DISPLAY_PROPERTIES']['CLIENT_PLACE']['DISPLAY_VALUE'] ?>
                        </li>
                    <? } ?>

                    <? if ($arItem['DISPLAY_PROPERTIES']['CLIENT_SITE']) { ?>
                        <li>
                            <i class="fa fa-globe color-green"></i>
                            <a class="linked" href="<?= $arItem['DISPLAY_PROPERTIES']['CLIENT_SITE']['VALUE'] ?>" target="_blank">
                                <?= $arItem['DISPLAY_PROPERTIES']['CLIENT_SITE']['VALUE'] ?>
                            </a>
                        </li>
                    <? } ?>

                    <? if ($arItem['DISPLAY_PROPERTIES']['CLIENT_SCOPE']) { ?>
                        <li>
                            <i class="fa fa-briefcase color-green"></i>
                            <?= $arItem['DISPLAY_PROPERTIES']['CLIENT_SCOPE']['DISPLAY_VALUE'] ?>
                        </li>
                    <? } ?>
                </ul>
                <p><?= $arItem['PREVIEW_TEXT'] ?></p>
            </div>
        </div>
        <?
    }

    // Bottom Pagination
    if ($arParams['DISPLAY_BOTTOM_PAGER']) {
        $this->SetViewTarget('pagination');
        ?>
        <div class="text-right">
            <?= $arResult['NAV_STRING'] ?>
        </div>
        <?
        $this->EndViewTarget('pagination');
    }
}