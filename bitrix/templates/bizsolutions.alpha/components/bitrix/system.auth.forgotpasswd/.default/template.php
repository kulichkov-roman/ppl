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
$APPLICATION->SetTitle(GetMessage('ALPHA_FORGOT_TITLE'));
$arClear = array('login', 'logout', 'register', 'forgot_password', 'change_password');
?>

    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <form id="authForm" class="reg-page" name="bform" method="post" target="_top" action="<?= $arResult['AUTH_URL'] ?>">
                <div class="reg-header">
                    <h2><?= GetMessage('ALPHA_FORGOT_TITLE') ?></h2>
                    <p><?= GetMessage('ALPHA_FORGOT_DESCRIPTION') ?></p>
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

                <? if (strlen($arResult['BACKURL']) > 0) { ?>
                    <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>" />
                <? } ?>

                <input type="hidden" name="AUTH_FORM" value="Y">
                <input type="hidden" name="TYPE" value="SEND_PWD">

                <div class="form-group has-feedback no-margin-bottom">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control restoreField" name="USER_LOGIN" placeholder="<?= GetMessage('ALPHA_FORGOT_LOGIN') ?>" value="<?= $arResult['LAST_LOGIN'] ?>"/>
                    </div>
                </div>

                <div class="text-center"><?= GetMessage('ALPHA_FORGOT_OR') ?></div>

                <div class="form-group has-feedback">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="text" class="form-control restoreField" name="USER_EMAIL" placeholder="<?= GetMessage('ALPHA_FORGOT_EMAIL') ?>"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        <button class="btn-u pull-right" type="submit"><?= GetMessage('ALPHA_FORGOT_SEND') ?></button>
                    </div>
                </div>

                <hr>

                <h4><?= GetMessage('ALPHA_FORGOT_REMEMBER') ?></h4>
                <p>
                    <?= GetMessage('ALPHA_FORGOT_AUTH_1') ?>
                    <a href="<?= $APPLICATION->GetCurPageParam('login=yes', $arClear) ?>"><?= GetMessage('ALPHA_FORGOT_AUTH_2') ?></a>
                    <?= GetMessage('ALPHA_FORGOT_AUTH_3') ?>
                </p>
            </form>
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
                    USER_EMAIL: {
                        validators: {
                            emailAddress: {
                                message: '<?= GetMessage('ALPHA_ERROR_EMAIL')?>'
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