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
$this->createFrame()->begin();

if ($arResult['NavShowAlways'] || $arResult['NavPageCount'] > 1) {
    ?>
    <!-- Begin Pagination -->
    <ul class="pagination">
        <? if ($arResult['NAV']['PAGE_NUMBER'] == 1) { ?>
            <li><a><i class="fa fa-angle-double-left"></i></a></li>
        <? } else { ?>
            <li><a href="<?= $arResult['NAV']['URL']['PREV_PAGE'] ?>"><i class="fa fa-angle-double-left"></i></a></li>
        <? } ?>

        <? for ($PAGE_NUMBER = $arResult['NAV']['START_PAGE']; $PAGE_NUMBER <= $arResult['NAV']['END_PAGE']; $PAGE_NUMBER++) { ?>
            <? if ($PAGE_NUMBER == $arResult['NAV']['PAGE_NUMBER']) { ?>
                <li class="active"><a><?= $PAGE_NUMBER ?></a></li>
            <? } else { ?>
                <li><a href="<?= $arResult['NAV']['URL']['SOME_PAGE'][$PAGE_NUMBER] ?>"><?= $PAGE_NUMBER ?></a></li>
            <? } ?>
        <? } ?>

        <? if ($arResult['NAV']['PAGE_NUMBER'] == $arResult['NAV']['PAGE_COUNT']) { ?>
            <li><a><i class="fa fa-angle-double-right"></i></a></li>
        <? } else { ?>
            <li><a href="<?= $arResult['NAV']['URL']['NEXT_PAGE'] ?>"><i class="fa fa-angle-double-right"></i></a></li>
        <? } ?>
    </ul>
    <!-- End Pagination -->
    <?
}