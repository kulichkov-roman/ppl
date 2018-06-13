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

$arSlides = array();
if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $key => $arItem) {
        $arSlide = array();

        // Background processing
        if (!$arItem['DETAIL_PICTURE']) continue;
        $arSlide['BACKGROUND'] = $arItem['DETAIL_PICTURE']['SRC'];

        // Shading disable
        if ($arItem['DISPLAY_PROPERTIES']['NO_SHADING']['VALUE']) {
            $arSlide['NO_SHADING'] = 'Y';
        }

        // Areas sequence
        $viewType = $arItem['DISPLAY_PROPERTIES']['SLIDE_VIEW']['VALUE_XML_ID'];
        if (isset($viewType)) {
            switch ($viewType) {
                case 'TEXT_FULL':
                    $arAreas = array(
                        'TEXT' => array(),
                    );
                    break;

                case 'TEXT_LEFT':
                    $arAreas = array(
                        'TEXT'  => array(),
                        'IMAGE' => array(),
                    );
                    break;

                case 'TEXT_RIGHT':
                    $arAreas = array(
                        'IMAGE' => array(),
                        'TEXT'  => array(),
                    );
                    break;

                case 'TEXT_NONE':
                    break;
            }
        }

        // Areas processing
        if (!empty($arAreas)) {
            // Text Block
            if (isset($arAreas['TEXT'])) {
                $arText = array(
                    'NAME' => $arItem['DISPLAY_PROPERTIES']['SLIDE_NAME']['DISPLAY_VALUE'],
                    'DESC' => $arItem['DISPLAY_PROPERTIES']['SLIDE_DESC']['~VALUE'],
                );

                // First button
                if (isset($arItem['DISPLAY_PROPERTIES']['BUTTON_1_TEXT'])) {
                    $arButton = array(
                        'TITLE' => $arItem['DISPLAY_PROPERTIES']['BUTTON_1_TEXT']['DISPLAY_VALUE'],
                        'LINK'  => $arItem['DISPLAY_PROPERTIES']['BUTTON_1_LINK']['VALUE'],
                    );

                    $arButton['COLOR'] = '';
                    if ($color = getColorCode($arItem['DISPLAY_PROPERTIES']['BUTTON_1_COLOR']['VALUE'])) {
                        $arButton['COLOR'] = ' btn-u-' . $color;
                    }

                    if (substr_count($arButton['LINK'], '/include/modals/') > 0) {
                        $arButton['MODAL_TRIGGER'] = 'Y';
                    }

                    $arText['BUTTONS'][] = $arButton;
                    unset ($arButton);
                }

                // Second button
                if (isset($arItem['DISPLAY_PROPERTIES']['BUTTON_2_TEXT'])) {
                    $arButton = array(
                        'TITLE' => $arItem['DISPLAY_PROPERTIES']['BUTTON_2_TEXT']['DISPLAY_VALUE'],
                        'LINK'  => $arItem['DISPLAY_PROPERTIES']['BUTTON_2_LINK']['VALUE'],
                    );

                    $arButton['COLOR'] = '';
                    if ($color = getColorCode($arItem['DISPLAY_PROPERTIES']['BUTTON_2_COLOR']['VALUE'])) {
                        $arButton['COLOR'] = ' btn-u-' . $color;
                    }

                    if (substr_count($arButton['LINK'], '/include/modals/') > 0) {
                        $arButton['MODAL_TRIGGER'] = 'Y';
                    }

                    $arText['BUTTONS'][] = $arButton;
                    unset ($arButton);
                }

                $arAreas['TEXT'] = $arText;
            }

            // Image Block
            if (isset($arAreas['IMAGE'])) {
                $arAreas['IMAGE']['SRC'] = $arItem['PREVIEW_PICTURE']['SRC'];
            }

            // Save Areas
            $arSlide['AREAS'] = $arAreas;
            unset($arAreas);
        }

        // Save Slides
        $arSlides[$key] = $arSlide;
        unset($arSlide, $viewType);
    }

    if (is_object($cp) && $arSlides) {
        $cp->arResult['SLIDES'] = $arSlides;
        unset($arSlides);
    }
}