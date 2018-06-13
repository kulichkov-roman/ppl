<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
/** @global CMain $APPLICATION */
$APPLICATION->SetTitle('Контакты');
?>

<? $APPLICATION->IncludeComponent(
    'bitrix:map.yandex.view',
    'yandex.view',
    array(
        'INIT_MAP_TYPE'      => 'MAP',
        'MAP_DATA'           => "a:4:{s:10:\"yandex_lat\";d:54.96486250679698;s:10:\"yandex_lon\";d:73.38459145767207;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:73.3845270846554;s:3:\"LAT\";d:54.9648871981692;s:4:\"TEXT\";s:18:\"Business Solutions\";}}}",
        'MAP_WIDTH'          => '100%',
        'MAP_HEIGHT'         => '348',
        'CONTROLS'           => array('ZOOM', 'TYPECONTROL'),
        'OPTIONS'            => array('ENABLE_DBLCLICK_ZOOM', 'ENABLE_DRAGGING'),
        'MAP_ID'             => ''
    )
); ?>

<!--=== Content Part ===-->
<div class="container content">
    <div class="row margin-bottom-30">
        <div class="col-md-9 mb-margin-bottom-30">
            <? $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                array(
                    'AREA_FILE_SHOW'   => 'sect',
                    'AREA_FILE_SUFFIX' => 'main_1',
                )
            ); ?>

            <? $APPLICATION->IncludeComponent(
                'bizsolutions:main.feedback',
                'contacts.form',
                array(
                    'USE_CAPTCHA'      => 'Y',
                    'OK_TEXT'          => 'Спасибо, ваше сообщение принято.',
                    'EMAIL_TO'         => '',
                    'REQUIRED_FIELDS'  => array(),
                    'EVENT_MESSAGE_ID' => array(0 => '7'),
                    'AJAX_MODE'        => 'Y',
                )
            ); ?>
        </div><!--/col-md-9-->

        <div class="col-md-3">
            <!-- Contacts -->
            <? $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                array(
                    'AREA_FILE_SHOW'   => 'sect',
                    'AREA_FILE_SUFFIX' => 'aside_1',
                )
            ); ?>

            <!-- Business Hours -->
            <? $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                array(
                    'AREA_FILE_SHOW'   => 'sect',
                    'AREA_FILE_SUFFIX' => 'aside_2',
                )
            ); ?>

            <!-- Why we are? -->
            <? $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                array(
                    'AREA_FILE_SHOW'   => 'sect',
                    'AREA_FILE_SUFFIX' => 'aside_3',
                )
            ); ?>
        </div><!--/col-md-3-->
    </div><!--/row-->

</div><!--/container-->
<!--=== End Content Part ===-->

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>