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

$blockName = !empty($arParams['CUSTOM_NAME']) ? $arParams['CUSTOM_NAME'] : GetMessage('ALPHA_DEFAULT_NAME');
$blockMore = !empty($arParams['CUSTOM_MORE']) ? $arParams['CUSTOM_MORE'] : GetMessage('ALPHA_DEFAULT_MORE');
$blockLink = str_replace('#SITE_DIR#', rtrim(SITE_DIR, '/'), $arResult['LIST_PAGE_URL']);
?>
<div class="panel panel-white equal-height-column no-margin-bottom">
    <div class="panel-heading overflow-h">
        <h3 class="panel-title pull-left"><i class="fa fa-newspaper-o"></i> <?= $blockName ?></h3>
        <a href="<?= $blockLink ?>" class="btn-u btn-u-sm pull-right"><?= $blockMore ?></a>
    </div>
    <div class="panel-body">
        <? if (!empty($arResult['ITEMS'])) { ?>
            <ul class="list-unstyled owl-ts-v1">
                <? foreach ($arResult['ITEMS'] as $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));
                    ?>
                    <li class="item" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                        <h4>
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                        </h4>
                        <? if (!empty($arItem['PREVIEW_PICTURE'])) { ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img-responsive" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                                    <div class="md-margin-bottom-20"></div>
                                </div>
                                <div class="col-md-8">
                                    <p><?= $arItem['PREVIEW_TEXT'] ?></p>
                                </div>
                            </div>
                        <? } else { ?>
                            <p><?= $arItem['PREVIEW_TEXT'] ?></p>
                        <? } ?>
                    </li>
                <? } ?>
            </ul>
        <? } ?>
    </div>
</div>