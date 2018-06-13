<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
/** @global CMain $APPLICATION */
?>

<? $APPLICATION->IncludeComponent(
    'bizsolutions:simple.add.form',
    'modal.question',
    array(
        'AJAX_MODE'    => 'Y',
        'IBLOCK_TYPE'  => 'feedback',
        'IBLOCK_ID'    => IBLOCK_QUESTION,
        'FORM_TYPE'    => 'QUESTION',
        'FIELD_CODES'  => array(
            0 => 'USER_NAME',
            1 => 'USER_EMAIL',
            2 => 'USER_PHONE',
            3 => 'USER_SUBJECT',
            4 => 'USER_TEXT',
        ),
        'INFORM_ADMIN' => 'Y',
        'USE_CAPTCHA'  => 'N',
        'SUBJECT_ID'   => intval($_GET['subject']),
    )
); ?>