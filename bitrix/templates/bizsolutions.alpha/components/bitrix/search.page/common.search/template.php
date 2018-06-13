<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
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
?>

<!--=== Search Block Version 2 ===-->
<div class="search-block-v2">
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <h2><?= GetMessage('ALPHA_SEARCH_TITLE') ?></h2>
            <form action="" method="get">
                <? // Show where to search
                if ($arParams['SHOW_WHERE']) { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="where" class="form-control">
                                <option value=""><?= GetMessage('ALPHA_SEARCH_ALL') ?></option>
                                <? foreach ($arResult['DROPDOWN'] as $key => $value) { ?>
                                    <option value="<?= $key ?>"<? if ($arResult['REQUEST']['WHERE'] == $key) echo ' selected' ?>><?= $value ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                <? } else { ?>
                    <div class="col-md-12">
                <? } ?>
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="<?= GetMessage('ALPHA_SEARCH_PLACEHOLDER') ?>" value="<?= $arResult['REQUEST']['QUERY'] ?>">
                        <span class="input-group-btn">
                            <button class="btn-u" type="submit"><?= GetMessage('ALPHA_SEARCH_GO') ?></button>
                        </span>
                    </div>
                </div>

                <input type="hidden" name="how" value="<? echo $arResult['REQUEST']['HOW'] == 'd' ? 'd' : 'r' ?>"/>
            </form>
        </div>
    </div>
</div><!--/container-->
<!--=== End Search Block Version 2 ===-->

<!--=== Search Results ===-->
<div class="container s-results margin-bottom-50">
    <? if (isset($arResult['REQUEST']['ORIGINAL_QUERY'])) { ?>
        <p>
            <?= GetMessage('ALPHA_SEARCH_KEYBOARD', array('#QUERY#' => '<a href="' . $arResult['ORIGINAL_QUERY_URL'] . '">' . $arResult['REQUEST']['ORIGINAL_QUERY'] . '</a>'))?>
        </p>
    <? } ?>

    <? if ($arResult['SEARCH_TOTAL']) { ?>
        <span class="results-number"><?= GetMessage('ALPHA_SEARCH_TOTAL', array('#TOTAL#' => $arResult['SEARCH_TOTAL']))?></span>
    <? } ?>

    <? if ($arResult['REQUEST']['QUERY'] === false && $arResult['REQUEST']['TAGS'] === false) { ?>
    <? } elseif ($arResult['ERROR_CODE'] != 0) { ?>

        <div class="alert alert-warning">
            <strong><?= GetMessage('ALPHA_SEARCH_ERROR') ?></strong><br/>
            <?= $arResult['ERROR_TEXT'] ?>
            <?= GetMessage('ALPHA_SEARCH_CORRECT_AND_CONTINUE') ?>
        </div>

        <p class="margin-bottom-20"><?= GetMessage('ALPHA_SEARCH_SINTAX') ?></p>

        <div class="col-md-12">
            <div class="row">
                <div class="panel panel-default margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-gear"></i> <?= GetMessage('ALPHA_SEARCH_LOGIC') ?></h3>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th><?= GetMessage('ALPHA_SEARCH_OPERATOR') ?></th>
                            <th><?= GetMessage('ALPHA_SEARCH_SYNONIM') ?></th>
                            <th><?= GetMessage('ALPHA_SEARCH_DESCRIPTION') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= GetMessage('ALPHA_SEARCH_AND') ?></td>
                            <td>and, &amp;, +</td>
                            <td><?= GetMessage('ALPHA_SEARCH_AND_ALT') ?></td>
                        </tr>
                        <tr>
                            <td><?= GetMessage('ALPHA_SEARCH_OR') ?></td>
                            <td>or, |</td>
                            <td><?= GetMessage('ALPHA_SEARCH_OR_ALT') ?></td>
                        </tr>
                        <tr>
                            <td><?= GetMessage('ALPHA_SEARCH_NOT') ?></td>
                            <td>not, ~</td>
                            <td><?= GetMessage('ALPHA_SEARCH_NOT_ALT') ?></td>
                        </tr>
                        <tr>
                            <td>( )</td>
                            <td>&nbsp;</td>
                            <td><?= GetMessage('ALPHA_SEARCH_BRACKETS_ALT') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <? } elseif (count($arResult['SEARCH']) > 0) {
        foreach ($arResult['SEARCH'] as $arItem) {
            ?>
            <div class="inner-results">
                <h3>
                    <a href="<?= $arItem['URL'] ?>"><?= $arItem['TITLE'] ?></a>
                </h3>
                <p><?= $arItem['BODY_FORMATED'] ?></p>

                <ul class="list-inline down-ul">
                    <li><?= GetMessage('ALPHA_SEARCH_MODIFIED') ?> <?= $arItem['DATE_CHANGE'] ?></li>
                    <? if ($arItem['CHAIN_PATH']) { ?>
                        <li><?= GetMessage('ALPHA_SEARCH_PATH') ?>&nbsp;<?= $arItem['CHAIN_PATH'] ?></li>
                    <? } ?>
                </ul>
            </div>

            <hr/>
            <?
        }
        ?>
        <p>
            <? if ($arResult['REQUEST']['HOW'] == 'd') { ?>
                <a href="<?= $arResult['URL'] ?>&amp;how=r<?= ($arResult['REQUEST']['FROM'] ? '&amp;from=' . $arResult['REQUEST']['FROM'] : '') ?> <?= ($arResult['REQUEST']['TO'] ? '&amp;to=' . $arResult['REQUEST']['TO'] : '') ?>">
                    <?= GetMessage('ALPHA_SEARCH_SORT_BY_RANK') ?>
                </a>
                &nbsp;|&nbsp;
                <b><?= GetMessage('ALPHA_SEARCH_SORTED_BY_DATE') ?></b>
            <? } else { ?>
                <b><?= GetMessage('ALPHA_SEARCH_SORTED_BY_RANK') ?></b>
                &nbsp;|&nbsp;
                <a href="<?= $arResult['URL'] ?>&amp;how=d<?= ($arResult['REQUEST']['FROM'] ? '&amp;from=' . $arResult['REQUEST']['FROM'] : '') ?> <?= ($arResult['REQUEST']['TO'] ? '&amp;to=' . $arResult['REQUEST']['TO'] : '') ?>">
                    <?= GetMessage('ALPHA_SEARCH_SORT_BY_DATE') ?>
                </a>
            <? } ?>
        </p>

        <div class="margin-bottom-30"></div>

        <? if ($arParams['DISPLAY_BOTTOM_PAGER'] != 'N') { ?>
            <div class="text-left">
                <?= $arResult['NAV_STRING'] ?>
            </div>
        <? } ?>

    <? } else { ?>
        <div class="alert alert-warning">
            <?= GetMessage('ALPHA_NOTHING_TO_FOUND') ?>
        </div>
    <? } ?>
</div><!--/container-->
<!--=== End Search Results ===-->