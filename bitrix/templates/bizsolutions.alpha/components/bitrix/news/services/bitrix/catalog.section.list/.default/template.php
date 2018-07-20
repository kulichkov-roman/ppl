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

if (!empty($arResult['SECTIONS'])) {
    ?>
    <div class="row service-box-v1 equal-height-columns">
        <? foreach ($arResult['SECTIONS'] as $arSection) {
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('ALPHA_DELETE_CONFIRM')));
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="service-block service-block-default margin-bottom-40 equal-height-column" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                    <a href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                        <? if (!empty($arSection['RESIZED_PICTURE'])) { ?>
                            <img class="img-responsive full-width" src="<?= $arSection['RESIZED_PICTURE']['SRC'] ?>" alt="<?= $arSection['PICTURE']['ALT'] ?>" title="<?= $arSection['PICTURE']['TITLE'] ?>"/>
                        <? } elseif ($arSection['UF_ICON']) { ?>
                            <i class="icon-lg rounded-x icon<?= ' ' . $arSection['UF_ICON'] ?>"></i>
                        <? } ?>
                        <h2 class="heading-sm"><?= $arSection['NAME'] ?></h2>
                    </a>
                </div>
            </div>
        <? } ?>
    </div>
<? }