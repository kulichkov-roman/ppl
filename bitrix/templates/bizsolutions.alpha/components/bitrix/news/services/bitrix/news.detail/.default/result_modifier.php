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

$cp = $this->__component;

// Detail picture META's
if ($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']) {
    $cp->arResult['DETAIL_PICTURE']['ALT'] = $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'];
}
if ($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']) {
    $cp->arResult['DETAIL_PICTURE']['TITLE'] = $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'];
}

$arTabs = array();
if (!empty($arResult['DISPLAY_PROPERTIES'])) {
    foreach($arResult['DISPLAY_PROPERTIES'] as $code => $arProperty) {
        if (strpos($code, 'SERVICE_TAB_') === 0) {
            $arTabs[$code] = $arProperty;
        }
    }
}

// documents processing
$arIcons = array(
    'pdf'  => 'fa-file-pdf-o',
    'txt'  => 'fa-file-text-o',
    'xls'  => 'fa-file-excel-o',
    'xlsx' => 'fa-file-excel-o',
    'doc'  => 'fa-file-word-o',
    'docx' => 'fa-file-word-o',
    'zip'  => 'fa-file-zip-o',
    'rar'  => 'fa-file-zip-o',
);

foreach ($arTabs as &$arTab) {
    if ($arTab['PROPERTY_TYPE'] == 'F' && $arTab['MULTIPLE'] == 'Y') {
        // FileValue to Array
        $itemsCount = count($arTab['VALUE']);
        if ($itemsCount == 1) {
            $fileValue = $arTab['FILE_VALUE'];
            unset($arTab['FILE_VALUE']);
            $arTab['FILE_VALUE'][0] = $fileValue;
        }

        // Get File Icon
        foreach ($arTab['FILE_VALUE'] as &$arFile) {
            $fileExt = end(explode('.', $arFile['ORIGINAL_NAME']));
            $arFile['ICON_CLASS'] = 'fa-file-o';
            if (array_key_exists($fileExt, $arIcons)) {
                $arFile['ICON_CLASS'] = $arIcons[$fileExt];
            }
        }
    }
}

if (is_object($cp)) {
    $cp->arResult['TABS'] = $arTabs;
}