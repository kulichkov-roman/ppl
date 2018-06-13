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

if (!empty($arResult)) {
    $qFormUrl = SITE_DIR . 'include/modals/modal.question.php?subject=' . $arResult['ID'];
    $oFormUrl = SITE_DIR . 'include/modals/modal.order.php?subject=' . $arResult['ID'];
    ?>
    <div class="row margin-bottom-40">
        <div class="col-sm-6">
            <? if (!empty($arResult['DETAIL_PICTURE'])) { ?>
                <img class="img-responsive full-width" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['DETAIL_PICTURE']['ALT'] ?>" title="<?= $arResult['DETAIL_PICTURE']['TITLE'] ?>"/>
            <? } ?>
        </div>

        <div class="col-sm-6">
            <div class="headline margin-bottom-30">
                <h2><?= $arResult['NAME'] ?></h2>
            </div>

            <div class="tag-box tag-box-v2 no-margin">
                <? if ($arResult['DISPLAY_PROPERTIES']['SERVICE_INCUT_1']) { ?>
                    <?= $arResult['DISPLAY_PROPERTIES']['SERVICE_INCUT_1']['DISPLAY_VALUE'] ?>
                <? } ?>
                <div class="text-center">
                    <a href="<?= $qFormUrl ?>" class="btn-u btn-u-default margin-right-10" data-toggle="modal" data-target="#alpha-modal">
                        <i class="fa fa-comment-o"></i>
                        <span class="hidden-xs"><?= GetMessage('ALPHA_QUESTION_TITLE') ?></span>
                    </a>
                    <a href="<?= $oFormUrl ?>" class="btn-u" data-toggle="modal" data-target="#alpha-modal">
                        <i class="fa fa-shopping-cart"></i>
                        <span><?= GetMessage('ALPHA_ORDER_TITLE') ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-v2 margin-bottom-40">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab-desc" data-toggle="tab">
                    <span class="visible-xs">
                        <i class="fa fa-info"></i>
                    </span>
                    <span class="hidden-xs">
                        <?= GetMessage('ALPHA_DESCRIPTION_TITLE') ?>
                    </span>
                </a>
            </li>
            <? foreach ($arResult['TABS'] as $arTab) { ?>
                <li>
                    <a href="#tab-<?= $arTab['ID'] ?>" data-toggle="tab"><?= $arTab['NAME'] ?></a>
                </li>
            <? } ?>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-desc">
                <h4 class="margin-bottom-20"><?= GetMessage('ALPHA_DESCRIPTION_TITLE') ?></h4>
                <?= $arResult['DETAIL_TEXT'] ?>
            </div>
            <? foreach ($arResult['TABS'] as $arTab) { ?>
                <div class="tab-pane fade" id="tab-<?= $arTab['ID'] ?>">
                    <h4 class="margin-bottom-20"><?= $arTab['NAME'] ?></h4>
                    <? // For Text fields
                    if (in_array($arTab['PROPERTY_TYPE'], array('S', 'N'))) { ?>
                        <?= $arTab['DISPLAY_VALUE'] ?>
                    <? }

                    // For File fields
                    if (in_array($arTab['PROPERTY_TYPE'], array('F'))) {
                        if (!empty($arTab['FILE_VALUE']) && is_array($arTab['FILE_VALUE'])) { ?>
                            <ul class="list-unstyled document-list">
                                <? foreach ($arTab['FILE_VALUE'] as $arFile) { ?>
                                    <li>
                                        <i class="fa <?= $arFile['ICON_CLASS'] ?>"></i><?= $arFile['DESCRIPTION'] ?>
                                        <a href="<?= $arFile['SRC'] ?>" class="pull-right" target="_blank"><?= GetMessage('FILE_DOWNLOAD') ?></a>
                                    </li>
                                <? } ?>
                            </ul>
                            <?
                        }
                    } ?>
                </div>
            <? } ?>
        </div>
    </div>

    <? if ($arResult['DISPLAY_PROPERTIES']['SERVICE_INCUT_2']) { ?>
        <div class="tag-box tag-box-v1">
            <div class="clearfix">
                <div class="col-sm-3 col-xs-2 text-left">
                    <div class="row">
                        <a href="<?= $qFormUrl ?>" class="btn-u btn-u-default margin-right-10" data-toggle="modal" data-target="#alpha-modal">
                            <i class="fa fa-comment-o"></i>
                            <span class="hidden-xs"><?= GetMessage('ALPHA_QUESTION_TITLE') ?></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-8">
                    <?= $arResult['DISPLAY_PROPERTIES']['SERVICE_INCUT_2']['DISPLAY_VALUE'] ?>
                </div>
                <div class="col-sm-3 col-xs-2 text-right">
                    <div class="row">
                        <a href="<?= $oFormUrl ?>" class="btn-u" data-toggle="modal" data-target="#alpha-modal">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="hidden-xs"><?= GetMessage('ALPHA_ORDER_TITLE') ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?
    }
}