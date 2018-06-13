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

if (!empty($arResult['SECTIONS'])) {
    // Get all UFs
    $dbSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID']), false, array('ID', 'UF_ICON'));
    while ($rsSection = $dbSections->GetNext(true, false)) {
        $arSections[$rsSection['ID']] = array(
            'UF_ICON' => $rsSection['UF_ICON'],
        );
    }

    foreach ($arResult['SECTIONS'] as $key => $arSection) {
        // Add UFs to Items
        $arTemp = $arSections[$arSection['ID']];
        if (is_object($cp) && !empty($arTemp)) {
            $cp->arResult['SECTIONS'][$key]['UF_ICON'] = $arTemp['UF_ICON'] ? getIconClass($arTemp['UF_ICON']) : 'icon-badge';
            unset($arTemp);
        }

        // Resize Section Picture {
        $arSize = array('width' => 660, 'height' => 660);
        if (!empty($arSection['PICTURE'])) {
            $arPicture = CFile::ResizeImageGet($arSection['PICTURE']['ID'], $arSize, BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $cp->arResult['SECTIONS'][$key]['RESIZED_PICTURE'] = array_change_key_case($arPicture, CASE_UPPER);
            unset($arPicture);
        }

        // Section picture META's
        if ($arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT'] && $arSection['PICTURE']) {
            $cp->arResult['SECTIONS'][$key]['PICTURE']['ALT'] = $arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT'];
        }
        if ($arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_TITLE'] && $arSection['PICTURE']) {
            $cp->arResult['SECTIONS'][$key]['PICTURE']['TITLE'] = $arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_TITLE'];
        }
    }
}