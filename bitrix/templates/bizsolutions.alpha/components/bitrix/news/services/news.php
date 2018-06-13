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
?>

<? $APPLICATION->IncludeComponent(
    'bitrix:catalog.section.list',
    '',
    Array(
        'IBLOCK_TYPE'        => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID'          => $arParams['IBLOCK_ID'],
        'SECTION_URL'        => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
        'COUNT_ELEMENTS'     => $arParams['SECTION_COUNT_ELEMENTS'],
        'TOP_DEPTH'          => $arParams['SECTION_TOP_DEPTH'],
        'ADD_SECTIONS_CHAIN' => $arParams['ADD_SECTIONS_CHAIN'],
        'CACHE_TYPE'         => $arParams['CACHE_TYPE'],
        'CACHE_TIME'         => $arParams['CACHE_TIME'],
        'CACHE_GROUPS'       => $arParams['CACHE_GROUPS'],
        'SEF_FOLDER'         => $arParams['SEF_FOLDER'],
    ),
    $component,
    array('HIDE_ICONS' => 'Y')
); ?>
