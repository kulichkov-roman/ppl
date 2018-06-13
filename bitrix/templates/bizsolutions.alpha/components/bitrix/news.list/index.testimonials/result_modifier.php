<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

$cp = $this->__component;

foreach ($arResult['ITEMS'] as $key => $arItem) {
    // Photo processing
    if (!$arItem['PREVIEW_PICTURE']) {
        $arPhoto = array(
            'SRC' => $this->__folder . '/images/user.jpg',
            'ALT' => $arItem['NAME'],
        );

        if (is_object($cp)) {
            $cp->arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $arPhoto;
        }
    }
    // Info processing
    $arInfo = array();
    if ($arItem['DISPLAY_PROPERTIES']['AUTHOR_POST']) {
        $arInfo[] = $arItem['DISPLAY_PROPERTIES']['AUTHOR_POST']['DISPLAY_VALUE'];
    }
    if ($arItem['DISPLAY_PROPERTIES']['AUTHOR_COMPANY']) {
        $arInfo[] = $arItem['DISPLAY_PROPERTIES']['AUTHOR_COMPANY']['DISPLAY_VALUE'];
    }
    if (is_object($cp)) {
        $cp->arResult['ITEMS'][$key]['INFO'] = implode(', ', $arInfo);
    }
}