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
    <div class="panel panel-white equal-height-column">
        <div class="panel-heading overflow-h">
            <h3 class="panel-title pull-left">
                <i class="fa fa-commenting-o"></i>
                <?= $blockName ?>
            </h3>
        </div>
        <div class="panel-body testimonials-v6">
            <div id="testimonials-1" class="carousel slide testimonials testimonials-v1">
                <div class="carousel-inner">
                    <? foreach ($arResult['ITEMS'] as $key => $arItem) {
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ALPHA_DELETE_CONFIRM')));
                        ?>
                        <div class="item<? if ($key == 0) { ?> active<? } ?> clearfix" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                            <p><?= $arItem['PREVIEW_TEXT'] ?></p>
                            <div class="testimonial-info">
                                <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                                <span class="testimonial-author">
                                    <?= $arItem['NAME'] ?>
                                    <em><?= $arItem['INFO'] ?></em>
                                </span>
                            </div>
                        </div>
                    <? } ?>
                </div>

                <div class="carousel-arrow">
                    <a class="left carousel-control" href="#testimonials-1" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right carousel-control" href="#testimonials-1" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?
}