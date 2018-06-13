<?
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
use Bitrix\Main\Page\Asset;

global $pageLayout;
?>
        <? // Sidebar Layout close if needed
        $sidebarLeft = getLeftSidebar();
        if (file_exists($sidebarLeft)) {
            // Tag Box wrapper close if needed
            if (!inDir($pageLayout['noTagbox'])) { ?>
                </div><!--/tag-box-->
            <? }
            // Outer pagination
            $APPLICATION->ShowViewContent('pagination'); ?>
            </div><!--/col-md-9-->
            </div><!--/row-->
        <? }

        // Container wrapper close if needed
        if (!inDir($pageLayout['noLayout'])) { ?>
            </div><!--/content-->
        <? } ?>
        </div>
            <!--=== Footer Version 1 ===-->
            <div class='footer-v1'>
                <div class='footer'>
                    <div class='container'>
                        <div class='row'>
                            <!-- About -->
                            <div class='col-md-3 md-margin-bottom-40'>
                                <!-- Logo -->
                                <div class='pull-left'>
                                    <? $APPLICATION->IncludeComponent(
                                        'bitrix:main.include',
                                        '',
                                        array(
                                            'AREA_FILE_SHOW'     => 'file',
                                            'PATH'               => SITE_DIR . 'include/footer.logo.php'
                                        )
                                    ); ?>
                                </div>
                                <!-- End Logo -->

                                <div class='company-info margin-bottom-20'>
                                    <? $APPLICATION->IncludeComponent(
                                        'bitrix:main.include',
                                        '',
                                        array(
                                            'AREA_FILE_SHOW'     => 'file',
                                            'PATH'               => SITE_DIR . 'include/footer.about.php'
                                        )
                                    ); ?>
                                </div>
                            </div>
                            <!-- End About -->

                            <!-- Link List -->
                            <div class='col-md-3 md-margin-bottom-40'>
                                <div class='headline'><h2><?= GetMessage('ALPHA_FOOTER_BLOCK_2') ?></h2></div>

                                <? $APPLICATION->IncludeComponent(
                                    'bitrix:menu',
                                    'footer.menu-bottom',
                                    array(
                                        'ROOT_MENU_TYPE'        => 'bottom',
                                        'MAX_LEVEL'             => '1',
                                        'USE_EXT'               => 'N',
                                        'MENU_CACHE_TYPE'       => 'A',
                                        'MENU_CACHE_TIME'       => '3600',
                                        'MENU_CACHE_USE_GROUPS' => 'Y',
                                    )
                                ); ?>
                            </div><!--/col-md-3-->
                            <!-- End Link List -->

                            <!-- Address -->
                            <div class='col-md-3 map-img md-margin-bottom-40'>
                                <div class='headline'><h2><?= GetMessage('ALPHA_FOOTER_BLOCK_3') ?></h2></div>

                                <address class='md-margin-bottom-40'>
                                    <? $APPLICATION->IncludeComponent(
                                        'bitrix:main.include',
                                        '',
                                        array(
                                            'AREA_FILE_SHOW'     => 'file',
                                            'PATH'               => SITE_DIR . 'include/footer.contacts.php'
                                        )
                                    ); ?>
                                </address>
                            </div><!--/col-md-3-->
                            <!-- End Address -->

                            <!-- Latest -->
                            <div class='col-md-3 md-margin-bottom-40'>
                                <div class='posts'>
                                    <div class='headline'><h2><?= GetMessage('ALPHA_FOOTER_BLOCK_1') ?></h2></div>

                                    <div class='company-info margin-bottom-20'>
                                        <? $APPLICATION->IncludeComponent(
                                            'bitrix:main.include',
                                            '',
                                            array(
                                                'AREA_FILE_SHOW'     => 'file',
                                                'PATH'               => SITE_DIR . 'include/footer.info.php'
                                            )
                                        ); ?>
                                    </div>

                                    <? $APPLICATION->IncludeComponent(
                                        'bizsolutions:ajax.subsribe.news',
                                        '',
                                        array(
                                            'AJAX_MODE' => 'Y',
                                        )
                                    ); ?>
                                </div>
                            </div><!--/col-md-3-->
                            <!-- End Latest -->
                        </div>
                    </div>
                </div><!--/footer-->

                <div class='copyright'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-md-4'>
                                <? $APPLICATION->IncludeComponent(
                                    'bitrix:main.include',
                                    '',
                                    array(
                                        'AREA_FILE_SHOW'     => 'file',
                                        'PATH'               => SITE_DIR . 'include/footer.copyright.php'
                                    )
                                ); ?>
                            </div>
                            <!-- Composite Banner -->
                            <div class="col-sm-4">
                                <div class="text-center margin-top-10" id="bx-composite-banner"></div>
                            </div>
                            <!-- Social Links -->
                            <div class='col-md-4'>
                                <? if (file_exists($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/footer.socials.php')) {
                                    include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/footer.socials.php');
                                } ?>
                            </div>
                            <!-- End Social Links -->
                        </div>
                    </div>
                </div><!--/copyright-->
            </div>
            <!--=== End Footer Version 1 ===-->

            <div class="modal fade" id="alpha-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>

            <div class="modal fade" id="alpha-modal-sm" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div><!--/wrapper-->
        <script type='text/javascript'>
            jQuery(document).ready(function() {
                App.init();
                App.initCounter();
                App.initParallaxBg();
                OwlCarousel.initOwlCarousel();

                // Bootstrap remote Modal Box clear content on hide
                $('#alpha-modal, #alpha-modal-sm').on('hidden.bs.modal', function (e) {
                    $(e.target).removeData('bs.modal');
                });
            });
        </script>
        <!--[if lt IE 9]>
            <script src="<?= SITE_TEMPLATE_PATH ?>/plugins/respond.min.js"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/plugins/html5shiv.min.js"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/plugins/placeholder-IE-fixes.min.js"></script>
        <![endif]-->
        <? $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            array(
                'AREA_FILE_SHOW' => 'file',
                'PATH'           => SITE_DIR . 'include/footer.counters.php',
            )
        ); ?>
    </body>
</html>