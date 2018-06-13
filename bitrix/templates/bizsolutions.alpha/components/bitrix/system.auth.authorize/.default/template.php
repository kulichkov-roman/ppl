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

$APPLICATION->SetTitle(GetMessage('ALPHA_AUTH_TITLE'));
$arClear = array('login', 'logout', 'register', 'forgot_password', 'change_password');
?>

    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <form id="authForm" class="reg-page "name="form_auth" method="post" target="_top" action="<?= $arResult['AUTH_URL'] ?>">
                <div class="reg-header">
                    <h2><?= GetMessage('ALPHA_AUTH_TITLE') ?></h2>
                </div>

                <? // Message Block
                if (isset($arParams['AUTH_RESULT']['MESSAGE']) && strlen($arParams['AUTH_RESULT']['MESSAGE']) > 0) {
                    $alertClass = 'alert alert-success';
                    if ($arParams['AUTH_RESULT']['TYPE'] == 'ERROR') {
                        $alertClass = 'alert alert-danger';
                    }
                    ?>
                    <div id="messBlock" class="<?= $alertClass ?>"><?= $arParams['~AUTH_RESULT']['MESSAGE'] ?></div>
                <? } else { ?>
                    <div id="messBlock" class="alert alert-danger hidden"></div>
                <? } ?>

                <input type="hidden" name="AUTH_FORM" value="Y"/>
                <input type="hidden" name="TYPE" value="AUTH"/>

                <? if (strlen($arResult['BACKURL']) > 0) { ?>
                    <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>"/>
                <? } ?>

                <? foreach ($arResult['POST'] as $key => $value) { ?>
                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                <? } ?>

                <div class="form-group has-feedback">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="USER_LOGIN" placeholder="<?= GetMessage('ALPHA_AUTH_LOGIN') ?>" value="<?= $arResult['LAST_LOGIN'] ?>"/>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="USER_PASSWORD" placeholder="<?= GetMessage('ALPHA_AUTH_PASSWORD') ?>"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 checkbox">
                        <label><input type="checkbox" name="USER_REMEMBER" value="Y"><?= GetMessage('ALPHA_AUTH_REMEMBER') ?></label>
                    </div>
                    <div class="col-md-6">
                        <button class="btn-u pull-right" type="submit" name="Login"><?= GetMessage('ALPHA_AUTH_AUTHORIZE') ?></button>
                    </div>
                </div>

                <hr>

                <h4><?= GetMessage('ALPHA_AUTH_FORGOT_1') ?></h4>
                <p>
                    <a href="<?= $arResult['AUTH_FORGOT_PASSWORD_URL'] ?>"><?= GetMessage('ALPHA_AUTH_FORGOT_2') ?></a>
                    <?= GetMessage('ALPHA_AUTH_FORGOT_3') ?>
                </p>
            </form>

            <? // Social Services
            if ($arResult['AUTH_SERVICES']) { ?>
                <br/>
                <p class="text-center small-text"><?= GetMessage('ALPHA_AUTH_SS_TITLE'); ?></p>
                <? $APPLICATION->IncludeComponent(
                    'bitrix:socserv.auth.form',
                    'icons',
                    array(
                        'AUTH_SERVICES'   => $arResult['AUTH_SERVICES'],
                        'CURRENT_SERVICE' => $arResult['CURRENT_SERVICE'],
                        'AUTH_URL'        => $arResult['AUTH_URL'],
                        'POST'            => $arResult['POST'],
                        'SHOW_TITLES'     => $arResult['FOR_INTRANET'] ? 'N' : 'Y',
                        'FOR_SPLIT'       => $arResult['FOR_INTRANET'] ? 'Y' : 'N',
                        'AUTH_LINE'       => $arResult['FOR_INTRANET'] ? 'N' : 'Y',
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                ); ?>
            <? } ?>
        </div>
    </div><!--/row-->

    <script>
        $(function () {
            var $messBlock = $('#messBlock');
            $('#authForm').bootstrapValidator({
                container: '#messBlock',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    USER_LOGIN: {
                        validators: {
                            notEmpty: {
                                message: '<?= GetMessage('ALPHA_ERROR_LOGIN')?>'
                            }
                        }
                    },
                    USER_PASSWORD: {
                        validators: {
                            notEmpty: {
                                message: '<?= GetMessage('ALPHA_ERROR_PASSWORD')?>'
                            }
                        }
                    }
                }
            }).on('error.field.bv', function () {
                // Show Message Block if has errors
                $messBlock.removeClass('hidden');
            }).on('success.field.bv', function () {
                // Hide Message Block if has no errors
                if ($messBlock.find('.help-block:visible').length <= 0) {
                    $messBlock.addClass('hidden');
                }
            });
        });
    </script>