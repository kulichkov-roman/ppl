<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
Loc::loadMessages(__FILE__);

// Theme Options
$themeWidth = Option::get(BS_MODULE_ID, 'width');
$themeHeader = Option::get(BS_MODULE_ID, 'header');
// Main Page Options
$mainPage = Option::get(BS_MODULE_ID, 'main');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?= LANGUAGE_ID ?>" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="<?= LANGUAGE_ID ?>" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="<?= LANGUAGE_ID ?>"> <!--<![endif]-->
<head>
    <? $APPLICATION->ShowHead() ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <?
    $objAsset = Asset::getInstance();
    // Favicon
    $objAsset->addString('<link rel="shortcut icon" href="' . SITE_DIR . 'favicon.ico">');
    // Viewport
    $objAsset->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');

    // Web Fonts
    $objAsset->addCss('//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin');
    $objAsset->addCss('//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
    // CSS Global Compulsory
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/plugins/bootstrap/css/bootstrap.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/plugins/bootstrap.validator/css/bootstrap-validator.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/ie8.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/blocks.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/plugins.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/app.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
    // CSS Header and Footer
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/headers/header-default.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/headers/header-v1.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/footers/footer-v1.css');
    // CSS Implementing Plugins
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/plugins/animate.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/plugins/line-icons/line-icons.css');
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/plugins/owl-carousel/owl.carousel.css');
    // CSS Theme Color
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/colors.min.css');
    // CSS for Specific Pages
    if (defined('ERROR_404')) {
        $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/pages/page_404_error.css');
    }
    // CSS Customization
    $objAsset->addCss(SITE_TEMPLATE_PATH . '/css/custom.css');

    // JS Global Compulsory
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/jquery/jquery.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/jquery/jquery-migrate.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/bootstrap/js/bootstrap.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/bootstrap.validator/js/bootstrap-validator.js');
    // JS Implementing Plugins
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/back-to-top.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/smoothScroll.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/jquery.flexslider/js/jquery.flexslider.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/owl-carousel/owl.carousel.js');

    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/jquery.parallax.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/counter/waypoints.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/counter/jquery.counterup.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/fancybox/jquery.fancybox.js');
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/plugins/jquery.inputmask/jquery.inputmask.bundle.js');
    // JS Customization
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/js/custom.js');
    // JS Main Scripts
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/js/app.js');
    // JS Page Level
    $objAsset->addJs(SITE_TEMPLATE_PATH . '/js/plugins/owl-carousel.js');

    CJSCore::Init();
    ?>
</head>

<?
// Body Options
$arBody = array();
if ($themeWidth == 'boxed') {
    $arBody[] = 'boxed-layout';
    $arBody[] = 'container';
}
if ($themeHeader == 'sticky') {
    $arBody[] = 'header-fixed';
}

$bodyClass = '';
if (!empty($arBody)) {
    $bodyClass = implode(' ', $arBody);
} ?>
<body<? if (strlen($bodyClass) > 0) { ?> class="<?= $bodyClass ?>"<? } ?>>
    <? $APPLICATION->ShowPanel() ?>

    <div class="wrapper">
        <!--=== Header ===-->
        <div class="header<? if ($themeHeader == 'sticky') { ?> header-sticky<? } ?>">
            <div class="topbar-v1 visible-md-block visible-lg-block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-inline top-v1-contacts">
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <? $APPLICATION->IncludeComponent(
                                        'bitrix:main.include',
                                        '',
                                        array(
                                            'AREA_FILE_SHOW'     => 'file',
                                            'EDIT_TEMPLATE'      => 'header.contact.php',
                                            'PATH'               => SITE_DIR . 'include/header.email.php'
                                        )
                                    ); ?>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <? $APPLICATION->IncludeComponent(
                                        'bitrix:main.include',
                                        '',
                                        array(
                                            'AREA_FILE_SHOW'     => 'file',
                                            'EDIT_TEMPLATE'      => 'header.contact.php',
                                            'PATH'               => SITE_DIR . 'include/header.phone.php'
                                        )
                                    ); ?>
                                </li>
                                <li class="call-back">
                                    <a href="<?= SITE_DIR ?>include/modals/modal.callback.php" class="btn-u btn-u-xs rounded" data-toggle="modal" data-target="#alpha-modal-sm">
                                        <? $APPLICATION->IncludeComponent(
                                            'bitrix:main.include',
                                            '',
                                            array(
                                                'AREA_FILE_SHOW'     => 'file',
                                                'EDIT_TEMPLATE'      => 'header.contact.php',
                                                'PATH'               => SITE_DIR . 'include/header.callback.php'
                                            )
                                        ); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-3">
                            <div class="topbar">
                                <? $APPLICATION->IncludeComponent(
                                    'bitrix:main.user.link',
                                    'header.user-link',
                                    array(
                                        'ID'                 => $USER->GetID(),
                                        'NAME_TEMPLATE'      => '#NAME# #LAST_NAME#',
                                        'SHOW_LOGIN'         => 'Y',
                                        'CACHE_TYPE'         => 'A',
                                        'CACHE_TIME'         => '7200'
                                    )
                                ); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <? if (file_exists($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/header.socials.php')) {
                                include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/header.socials.php');
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- Logo -->
                <div class="pull-left">
                    <? $APPLICATION->IncludeComponent(
                        'bitrix:main.include',
                        '',
                        array(
                            'AREA_FILE_SHOW'     => 'file',
                            'EDIT_TEMPLATE'      => '',
                            'PATH'               => SITE_DIR . 'include/header.logo.php'
                        )
                    ); ?>
                </div>
                <!-- End Logo -->

                <!-- Toggle get grouped for better mobile display -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only"><?= GetMessage('ALPHA_TOGGLE_NAVIGATION') ?></span>
                    <span class="fa fa-bars"></span>
                </button>
                <!-- End Toggle -->
            </div><!--/end container-->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
                <div class="container">
                    <!-- Search Block -->
                    <? $APPLICATION->IncludeComponent(
                        'bitrix:search.form',
                        'header.search-top',
                        array(
                            'PAGE' => SITE_DIR . 'search/index.php',
                        )
                    ); ?>
                    <!-- End Search Block -->

                    <!-- Menu Block -->
                    <? $APPLICATION->IncludeComponent(
                        'bitrix:menu',
                        'header.menu-top',
                        array(
                            'ROOT_MENU_TYPE'        => 'top',
                            'MAX_LEVEL'             => '4',
                            'CHILD_MENU_TYPE'       => 'left',
                            'USE_EXT'               => 'Y',
                            'MENU_CACHE_TYPE'       => 'A',
                            'MENU_CACHE_TIME'       => '3600',
                            'MENU_CACHE_USE_GROUPS' => 'Y',
                        )
                    ); ?>
                    <!-- End Menu Block -->
                </div><!--/end container-->
            </div><!--/navbar-collapse-->
        </div>
        <!--=== End Header ===-->

        <? // Page Types for wrappers
        $pageLayout = array(
            'noCrumbs' => array('/index.php'),
            'noLayout' => array('/index.php', '/search/', '/contacts/'),
            'noTagbox' => array('/news/', '/services/'),
        );

        ?>
        <div class="main-container">
        <?
        // Breadcrumbs
        if (!inDir($pageLayout['noCrumbs'])) {
            ?>
            <div class="breadcrumbs<? if (inDir(array('/search/'))) { ?> breadcrumbs-dark<? } ?>">
                <div class="container">
                    <h1 class="pull-left">
                        <? $APPLICATION->ShowTitle(false) ?>
                    </h1>

                    <? $APPLICATION->IncludeComponent(
                        'bitrix:breadcrumb',
                        'header.breadcrumb',
                        array(
                            'START_FROM' => '0',
                            'PATH'       => '',
                            'SITE_ID'    => SITE_ID,
                        )
                    ); ?>
                </div>
            </div>
            <?
        }

        // Container wrapper if needed
        if (!inDir($pageLayout['noLayout'])) { ?>
            <div class="container content<? if (inDir(array('/personal/'))) { ?> profile<? } ?>">

            <? // Sidebar Layout if needed
            $sidebarLeft = getLeftSidebar();
            if (file_exists($sidebarLeft)) { ?>
                <div class="row">
                    <div class="col-md-3"><? include($sidebarLeft) ?></div>
                    <div class="col-md-9">
                        <? // Tag Box wrapper if needed
                        if (!inDir($pageLayout['noTagbox'])) { ?>
                            <div class="tag-box tag-box-v3">
                        <? } ?>
                <?
            }
        }