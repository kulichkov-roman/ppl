<? include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
/** @global CMain $APPLICATION */

CHTTP::SetStatus('404 Not Found');
@define('ERROR_404', 'Y');

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$APPLICATION->SetTitle('Страница не найдена');
?>
    <!--Error Block-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="error-v1">
                <span class="error-v1-title">404</span>
                <span>Страница не найдена!</span>
                <p>Запрошенный URL не найден на этом сервере. Это все, что мы знаем.</p>
                <a class="btn-u btn-bordered" href="/">На главную</a>
            </div>
        </div>
    </div>
    <!--End Error Block-->

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>