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

use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__DIR__);

$useTerms = $arParams['BS_DISABLE_CONFIRM'] != 'Y';
?>
<form id="emailAddressForm" class="footer-subsribe" action="<?= $arResult['FORM_ACTION'] ?>" method="post">
    <div class="input-group">
        <div class="form-group has-feedback">
            <input type="text" name="email" class="form-control" placeholder="<?= Loc::getMessage('BS_EMAIL_TEXT') ?>">
        </div>
        <span class="input-group-btn">
            <button class="btn btn-u" type="submit"<? if ($useTerms) { ?> disabled="disabled"<? } ?>>
                <?= Loc::getMessage('BS_SUBMIT_TEXT') ?>
            </button>
        </span>
    </div>

    <div id="subscribeFormMsg">
        <?
        if (!empty($arResult['RESULT'])) {
            $alert = 'success';
            if ($arResult['RESULT']['STATUS'] == 'ERROR') {
                $alert = 'danger';
            }
            ?>
            <div class="alert alert-<?= $alert ?>"><?= $arResult['RESULT']['MESSAGE'] ?></div>
            <?
        }
        ?>
    </div>

    <? // Personal Data
    if ($useTerms)
    {
        $termsLink = SITE_DIR . ltrim(Option::get(BS_MODULE_ID, 'termsLink'), '/');
        ?>
        <label class="terms-block">
            <input type="checkbox" name="USER_TERMS">
            <span><?= Loc::getMessage('BS_CONFIRM_TITLE_1') ?><? if (strlen($termsLink) > 0) { ?><a href="<?= $termsLink ?>" target="_blank"><?= Loc::getMessage('BS_CONFIRM_TITLE_2') ?></a><? } else { ?><?= Loc::getMessage('BS_CONFIRM_TITLE_2') ?><? } ?></span>
        </label>
        <script>
            $(function () {
                $('.terms-block').click(function() {
                    var $submit = $(this).parents('form').find('[type="submit"]');
                    var $checkbox = $(this).find('[type="checkbox"]');

                    if ($checkbox.prop('checked')) {
                        $submit.attr('disabled', false);
                    } else {
                        $submit.attr('disabled', true);
                    }
                });
            });
        </script>
        <?
    } ?>
</form>

<script>
    $(function () {
        $('#emailAddressForm').bootstrapValidator({
            container: '#subscribeFormMsg',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        emailAddress: {
                            message: '<div class="alert alert-danger"><?=Loc::getMessage('BS_EMAIL_INVALID');?></div>'
                        },
                        notEmpty: {
                            message: '<div class="alert alert-danger"><?=Loc::getMessage('BS_EMAIL_EMPTY');?></div>'
                        }
                    }
                },
                USER_TERMS: {
                    validators: {
                          notEmpty: {
                            message: '<div class="alert alert-danger"><?=Loc::getMessage('BS_ERROR_REQ', array('#FIELD_NAME#' =>  Loc::getMessage('BS_CONFIRM_TITLE_1').Loc::getMessage('BS_CONFIRM_TITLE_2')))?></div>'
                        }
                    }
                }
            }
        });
    });
</script>