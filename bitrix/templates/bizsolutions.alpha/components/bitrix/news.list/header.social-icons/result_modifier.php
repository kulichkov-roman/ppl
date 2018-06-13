<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
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

if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $key => $arItem) {
        $arData = array(
            'HINT'   => $arItem['NAME'],
            'ICON'   => getIconClass($arItem['DISPLAY_PROPERTIES']['SOCIAL_ICON']['VALUE']),
            'LINK'   => $arItem['DISPLAY_PROPERTIES']['SOCIAL_LINK']['VALUE'],
            'TARGET' => '_self'
        );
        if ($arItem['DISPLAY_PROPERTIES']['SOCIAL_HINT']) {
            $arData['HINT'] = $arItem['DISPLAY_PROPERTIES']['SOCIAL_HINT']['VALUE'];
        }
        if ($arItem['DISPLAY_PROPERTIES']['SOCIAL_BLANK']) {
            $arData['TARGET'] = '_blank';
        }

        if (is_object($cp)) {
            $cp->arResult['ITEMS'][$key]['DATA'] = $arData;
        }
        unset($arData);
    }
}