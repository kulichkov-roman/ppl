<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
/** @global CMain $APPLICATION */
?>

<? $APPLICATION->IncludeComponent(
    'bizsolutions:simple.add.form',
    'modal.callback',
    array(
        'AJAX_MODE'         => 'Y',
        'AJAX_OPTION_JUMP'  => 'N',
        'AJAX_OPTION_STYLE' => 'Y',
        'IBLOCK_TYPE'       => 'feedback',
        'IBLOCK_ID'         => IBLOCK_CALLBACK,
        'FIELD_CODES'       => array(
            0 => 'USER_NAME',
            1 => 'USER_PHONE',
        ),
        'INFORM_ADMIN'      => 'Y',
        'USE_CAPTCHA'       => 'N',
        'FORM_TYPE'         => 'CALLBACK',
    )
); ?>