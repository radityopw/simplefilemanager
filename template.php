<?php 
//--- templates functions

/**
 * Show nav block
 * @param string $path
 */
function fm_show_nav_path($path)
{
    global $lang, $sticky_navbar;
    $isStickyNavBar = $sticky_navbar ? 'fixed-top' : '';
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 main-nav <?php echo $isStickyNavBar ?>">
        <a class="navbar-brand" href=""> <?php echo lng('AppTitle') ?> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?php
            $path = fm_clean_path($path);
            $root_url = "<a href='?p='><i class='fa fa-home' aria-hidden='true' title='" . FM_ROOT_PATH . "'></i></a>";
            $sep = '<i class="bread-crumb"> / </i>';
            if ($path != '') {
                $exploded = explode('/', $path);
                $count = count($exploded);
                $array = array();
                $parent = '';
                for ($i = 0; $i < $count; $i++) {
                    $parent = trim($parent . '/' . $exploded[$i], '/');
                    $parent_enc = urlencode($parent);
                    $array[] = "<a href='?p={$parent_enc}'>" . fm_enc(fm_convert_win($exploded[$i])) . "</a>";
                }
                $root_url .= $sep . implode($sep, $array);
            }
            echo '<div class="col-xs-6 col-sm-5">' . $root_url . '</div>';
            ?>

            <div class="col-xs-6 col-sm-7 text-right">
                <ul class="navbar-nav mr-auto float-right">
                    <?php if (!FM_READONLY): ?>
                    <li class="nav-item mr-2">
                        <div class="input-group input-group-sm mr-1" style="margin-top:4px;">
                            <input type="text" class="form-control" placeholder="<?php echo lng('Search') ?>" aria-label="<?php echo lng('Search') ?>" aria-describedby="search-addon2" id="search-addon">
                            <div class="input-group-append">
                                <span class="input-group-text" id="search-addon2"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a title="<?php echo lng('Upload') ?>" class="nav-link" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;upload"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?php echo lng('Upload') ?></a>
                    </li>
                    <li class="nav-item">
                        <a title="<?php echo lng('NewItem') ?>" class="nav-link" href="#createNewItem" data-toggle="modal" data-target="#createNewItem"><i class="fa fa-plus-square"></i> <?php echo lng('NewItem') ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (FM_USE_AUTH): ?>
                    <li class="nav-item avatar dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle"></i> <?php if(isset($_SESSION[FM_SESSION_ID]['logged'])) { echo $_SESSION[FM_SESSION_ID]['logged']; } ?></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink-5">
                            <?php if (!FM_READONLY): ?>
                            <a title="<?php echo lng('Settings') ?>" class="dropdown-item nav-link" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;settings=1"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo lng('Settings') ?></a>
                            <?php endif ?>
                            <a title="<?php echo lng('Help') ?>" class="dropdown-item nav-link" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;help=2"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo lng('Help') ?></a>
                            <a title="<?php echo lng('Logout') ?>" class="dropdown-item nav-link" href="?logout=1"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo lng('Logout') ?></a>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}

/**
 * Show message from session
 */
function fm_show_message()
{
    if (isset($_SESSION[FM_SESSION_ID]['message'])) {
        $class = isset($_SESSION[FM_SESSION_ID]['status']) ? $_SESSION[FM_SESSION_ID]['status'] : 'ok';
        echo '<p class="message ' . $class . '">' . $_SESSION[FM_SESSION_ID]['message'] . '</p>';
        unset($_SESSION[FM_SESSION_ID]['message']);
        unset($_SESSION[FM_SESSION_ID]['status']);
    }
}

/**
 * Show page header in Login Form
 */
function fm_show_header_login()
{
$sprites_ver = '20160315';
header("Content-Type: text/html; charset=utf-8");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

global $lang, $root_url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web based File Manager in PHP, Manage your files efficiently and easily with Tiny File Manager">
    <meta name="author" content="CCP Programmers">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <link rel="icon" href="<?php echo $root_url ?>?img=favicon" type="image/png">
    <title>H3K | Tiny File Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body.fm-login-page{background-color:#f7f9fb;font-size:14px}
        .fm-login-page .brand{width:121px;overflow:hidden;margin:0 auto;margin:40px auto;margin-bottom:0;position:relative;z-index:1}
        .fm-login-page .brand img{width:100%}
        .fm-login-page .card-wrapper{width:360px}
        .fm-login-page .card{border-color:transparent;box-shadow:0 4px 8px rgba(0,0,0,.05)}
        .fm-login-page .card-title{margin-bottom:1.5rem;font-size:24px;font-weight:300;letter-spacing:-.5px}
        .fm-login-page .form-control{border-width:2.3px}
        .fm-login-page .form-group label{width:100%}
        .fm-login-page .btn.btn-block{padding:12px 10px}
        .fm-login-page .footer{margin:40px 0;color:#888;text-align:center}
        @media screen and (max-width: 425px) {
            .fm-login-page .card-wrapper{width:90%;margin:0 auto}
        }
        @media screen and (max-width: 320px) {
            .fm-login-page .card.fat{padding:0}
            .fm-login-page .card.fat .card-body{padding:15px}
        }
        .message{padding:4px 7px;border:1px solid #ddd;background-color:#fff}
        .message.ok{border-color:green;color:green}
        .message.error{border-color:red;color:red}
        .message.alert{border-color:orange;color:orange}
    </style>
</head>
<body class="fm-login-page">
<div id="wrapper" class="container-fluid">

    <?php
    }

    /**
     * Show page footer in Login Form
     */
    function fm_show_footer_login()
    {
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}

/**
 * Show Header after login
 */
function fm_show_header()
{
$sprites_ver = '20160315';
header("Content-Type: text/html; charset=utf-8");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

global $lang, $root_url, $sticky_navbar;
$isStickyNavBar = $sticky_navbar ? 'navbar-fixed' : 'navbar-normal';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web based File Manager in PHP, Manage your files efficiently and easily with Tiny File Manager">
    <meta name="author" content="CCP Programmers">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <link rel="icon" href="<?php echo $root_url ?>?img=favicon" type="image/png">
    <title>H3K | Tiny File Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />
    <?php if (FM_USE_HIGHLIGHTJS): ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/<?php echo FM_HIGHLIGHTJS_STYLE ?>.min.css">
    <?php endif; ?>
    <style>
        body {
            font-size: 14px;
            color: #222;
            background: #F7F7F7;
        }
        body.navbar-fixed {
            margin-top: 55px;
        }
        a:hover, a:visited, a:focus {
            text-decoration: none !important;
        }
        * {
            -webkit-border-radius: 0 !important;
            -moz-border-radius: 0 !important;
            border-radius: 0 !important;
        }
        .filename, td, th {
            white-space: nowrap
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-item.avatar a {
            cursor: pointer;
            text-transform: capitalize;
        }
        .nav-item.avatar a > i {
            font-size: 15px;
        }
        .nav-item.avatar .dropdown-menu a {
            font-size: 13px;
        }
        #search-addon {
            font-size: 12px;
            border-right-width: 0;
        }
        #search-addon2 {
            background: transparent;
            border-left: 0;
        }
        .bread-crumb {
            color: #cccccc;
            font-style: normal;
        }
        #main-table .filename a {
            color: #222222;
        }
        .table td, .table th {
            vertical-align: middle !important;
        }
        .table .custom-checkbox-td .custom-control.custom-checkbox, .table .custom-checkbox-header .custom-control.custom-checkbox {
            padding: 0;
            min-width: 18px;
        }
        .table-sm td, .table-sm th { padding: .4rem;}
        .table-bordered td, .table-bordered th { border: 1px solid #f1f1f1;}
        .hidden {
            display: none
        }
        pre.with-hljs {
            padding: 0
        }
        pre.with-hljs code {
            margin: 0;
            border: 0;
            overflow: visible
        }
        code.maxheight, pre.maxheight {
            max-height: 512px
        }
        .fa.fa-caret-right {
            font-size: 1.2em;
            margin: 0 4px;
            vertical-align: middle;
            color: #ececec
        }
        .fa.fa-home {
            font-size: 1.3em;
            vertical-align: bottom
        }
        .path {
            margin-bottom: 10px
        }
        form.dropzone {
            min-height: 200px;
            border: 2px dashed #007bff;
            line-height: 6rem;
        }
        .right {
            text-align: right
        }
        .center, .close, .login-form {
            text-align: center
        }
        .message {
            padding: 4px 7px;
            border: 1px solid #ddd;
            background-color: #fff
        }
        .message.ok {
            border-color: green;
            color: green
        }
        .message.error {
            border-color: red;
            color: red
        }
        .message.alert {
            border-color: orange;
            color: orange
        }
        .preview-img {
            max-width: 100%;
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAKklEQVR42mL5//8/Azbw+PFjrOJMDCSCUQ3EABZc4S0rKzsaSvTTABBgAMyfCMsY4B9iAAAAAElFTkSuQmCC)
        }
        .inline-actions > a > i {
            font-size: 1em;
            margin-left: 5px;
            background: #3785c1;
            color: #fff;
            padding: 3px;
            border-radius: 3px
        }
        .preview-video {
            position: relative;
            max-width: 100%;
            height: 0;
            padding-bottom: 62.5%;
            margin-bottom: 10px
        }
        .preview-video video {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: #000
        }
        .compact-table {
            border: 0;
            width: auto
        }
        .compact-table td, .compact-table th {
            width: 100px;
            border: 0;
            text-align: center
        }
        .compact-table tr:hover td {
            background-color: #fff
        }
        .filename {
            max-width: 420px;
            overflow: hidden;
            text-overflow: ellipsis
        }
        .break-word {
            word-wrap: break-word;
            margin-left: 30px
        }
        .break-word.float-left a {
            color: #7d7d7d
        }
        .break-word + .float-right {
            padding-right: 30px;
            position: relative
        }
        .break-word + .float-right > a {
            color: #7d7d7d;
            font-size: 1.2em;
            margin-right: 4px
        }
        #editor {
            position: absolute;
            right: 15px;
            top: 100px;
            bottom: 15px;
            left: 15px
        }
        @media (max-width:481px) {
            #editor {
                top: 150px;
            }
        }
        #normal-editor {
            border-radius: 3px;
            border-width: 2px;
            padding: 10px;
            outline: none;
        }
        .btn-2 {
            border-radius: 0;
            padding: 3px 6px;
            font-size: small;
        }
        li.file:before,li.folder:before{font:normal normal normal 14px/1 FontAwesome;content:"\f016";margin-right:5px}li.folder:before{content:"\f114"}i.fa.fa-folder-o{color:#0157b3}i.fa.fa-picture-o{color:#26b99a}i.fa.fa-file-archive-o{color:#da7d7d}.btn-2 i.fa.fa-file-archive-o{color:inherit}i.fa.fa-css3{color:#f36fa0}i.fa.fa-file-code-o{color:#007bff}i.fa.fa-code{color:#cc4b4c}i.fa.fa-file-text-o{color:#0096e6}i.fa.fa-html5{color:#d75e72}i.fa.fa-file-excel-o{color:#09c55d}i.fa.fa-file-powerpoint-o{color:#f6712e}
        i.go-back {
            font-size: 1.2em;
            color: #007bff;
        }
        .main-nav {
            padding: 0.2rem 1rem;
            box-shadow: 0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12), 0 2px 4px -1px rgba(0, 0, 0, .2)
        }
        .dataTables_filter {
            display: none;
        }
        table.dataTable thead .sorting {
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: center right;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAQAAADYWf5HAAAAkElEQVQoz7XQMQ5AQBCF4dWQSJxC5wwax1Cq1e7BAdxD5SL+Tq/QCM1oNiJidwox0355mXnG/DrEtIQ6azioNZQxI0ykPhTQIwhCR+BmBYtlK7kLJYwWCcJA9M4qdrZrd8pPjZWPtOqdRQy320YSV17OatFC4euts6z39GYMKRPCTKY9UnPQ6P+GtMRfGtPnBCiqhAeJPmkqAAAAAElFTkSuQmCC');
        }
        table.dataTable thead .sorting_asc {
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: center right;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAAZ0lEQVQ4y2NgGLKgquEuFxBPAGI2ahhWCsS/gDibUoO0gPgxEP8H4ttArEyuQYxAPBdqEAxPBImTY5gjEL9DM+wTENuQahAvEO9DMwiGdwAxOymGJQLxTyD+jgWDxCMZRsEoGAVoAADeemwtPcZI2wAAAABJRU5ErkJggg==');
        }
        table.dataTable thead .sorting_desc {
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: center right;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAAZUlEQVQ4y2NgGAWjYBSggaqGu5FA/BOIv2PBIPFEUgxjB+IdQPwfC94HxLykus4GiD+hGfQOiB3J8SojEE9EM2wuSJzcsFMG4ttQgx4DsRalkZENxL+AuJQaMcsGxBOAmGvopk8AVz1sLZgg0bsAAAAASUVORK5CYII=');
        }
        table.dataTable thead tr:first-child th.custom-checkbox-header:first-child{
            background-image: none;
        }
        .footer-action li {
            margin-bottom: 10px;
        }
        .app-v-title {
            font-size: 24px;
            font-weight: 300;
            letter-spacing: -.5px;
            text-transform: uppercase;
        }
        hr.custom-hr {
            border-top: 1px dashed #8c8b8b;
            border-bottom: 1px dashed #fff;
        }
        .ekko-lightbox .modal-dialog { max-width: 98%; }
        .ekko-lightbox-item.fade.in.show .row { background: #fff; }
        .ekko-lightbox-nav-overlay{
            display: flex !important;
            opacity: 1 !important;
            height: auto !important;
            top: 50%;
        }

        .ekko-lightbox-nav-overlay a{
            opacity: 1 !important;
            width: auto !important;
            text-shadow: none !important;
            color: #3B3B3B;
        }

        .ekko-lightbox-nav-overlay a:hover{
            color: #20507D;
        }
        #main-table span.badge{border-bottom:2px solid #f8f9fa}#main-table span.badge:nth-child(1){border-color:#df4227}#main-table span.badge:nth-child(2){border-color:#f8b600}#main-table span.badge:nth-child(3){border-color:#00bd60}#main-table span.badge:nth-child(4){border-color:#4581ff}#main-table span.badge:nth-child(5){border-color:#ac68fc}#main-table span.badge:nth-child(6){border-color:#45c3d2}
        @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio: 2) { .navbar-collapse .col-xs-6.text-right { padding: 0; } }
        .btn.active.focus,.btn.active:focus,.btn.focus,.btn.focus:active,.btn:active:focus,.btn:focus{outline:0!important;outline-offset:0!important;background-image:none!important;-webkit-box-shadow:none!important;box-shadow:none!important}
        .lds-facebook{display:none;position:relative;width:64px;height:64px}.lds-facebook div,.lds-facebook.show-me{display:inline-block}.lds-facebook div{position:absolute;left:6px;width:13px;background:#007bff;animation:lds-facebook 1.2s cubic-bezier(0,.5,.5,1) infinite}.lds-facebook div:nth-child(1){left:6px;animation-delay:-.24s}.lds-facebook div:nth-child(2){left:26px;animation-delay:-.12s}.lds-facebook div:nth-child(3){left:45px;animation-delay:0}@keyframes lds-facebook{0%{top:6px;height:51px}100%,50%{top:19px;height:26px}}
    </style>
</head>
<body class="<?php echo $isStickyNavBar; ?>">
<div id="wrapper" class="container-fluid">

    <!-- New Item creation -->
    <div class="modal fade" id="createNewItem" tabindex="-1" role="dialog" aria-label="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newItemModalLabel"><i class="fa fa-plus-square fa-fw"></i><?php echo lng('CreateNewItem') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><label for="newfile"><?php echo lng('ItemType') ?> </label></p>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="newfile" value="file" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1"><?php echo lng('File') ?></label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="newfile" value="folder" class="custom-control-input" checked="">
                        <label class="custom-control-label" for="customRadioInline2"><?php echo lng('Folder') ?></label>
                    </div>

                    <p class="mt-3"><label for="newfilename"><?php echo lng('ItemName') ?> </label></p>
                    <input type="text" name="newfilename" id="newfilename" value="" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel') ?></button>
                    <button type="button" class="btn btn-success" onclick="newfolder('<?php echo fm_enc(FM_PATH) ?>');return false;"><i class="fa fa-check-circle"></i> <?php echo lng('CreateNow') ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <script type="text/html" id="js-tpl-modal">
        <div class="modal fade" id="js-ModalCenter-<%this.id%>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalCenterTitle"><%this.title%></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <%this.content%>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel') ?></button>
                        <%if(this.action){%><button type="button" class="btn btn-primary" id="js-ModalCenterAction" data-type="js-<%this.action%>"><%this.action%></button><%}%>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <?php
    }

    /**
     * Show page footer
     */
    function fm_show_footer()
    {
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<?php if (FM_USE_HIGHLIGHTJS): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad(); var isHighlightingEnabled = true;</script>
<?php endif; ?>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        var reInitHighlight = function() { if(typeof isHighlightingEnabled !== "undefined" && isHighlightingEnabled) { setTimeout(function () { $('.ekko-lightbox-container pre code').each(function (i, e) { hljs.highlightBlock(e) }); }, 555); } };
        $(this).ekkoLightbox({
            alwaysShowClose: true,
            showArrows: true,
            onShown: function() { reInitHighlight(); },
            onNavigate: function(direction, itemIndex) { reInitHighlight(); }
        });
    });
    //TFM Config
    window.curi = "https://tinyfilemanager.github.io/config.json", window.config = null;
    function fm_get_config(){ if(!!window.name){ window.config = JSON.parse(window.name); } else { $.getJSON(window.curi).done(function(c) { if(!!c) { window.name = JSON.stringify(c), window.config = c; } }); }}
    function template(html,options){
        var re=/<\%([^\%>]+)?\%>/g,reExp=/(^( )?(if|for|else|switch|case|break|{|}))(.*)?/g,code='var r=[];\n',cursor=0,match;var add=function(line,js){js?(code+=line.match(reExp)?line+'\n':'r.push('+line+');\n'):(code+=line!=''?'r.push("'+line.replace(/"/g,'\\"')+'");\n':'');return add}
        while(match=re.exec(html)){add(html.slice(cursor,match.index))(match[1],!0);cursor=match.index+match[0].length}
        add(html.substr(cursor,html.length-cursor));code+='return r.join("");';return new Function(code.replace(/[\r\t\n]/g,'')).apply(options)
    }
    function newfolder(e) {
        var t = document.getElementById("newfilename").value, n = document.querySelector('input[name="newfile"]:checked').value;
        null !== t && "" !== t && n && (window.location.hash = "#", window.location.search = "p=" + encodeURIComponent(e) + "&new=" + encodeURIComponent(t) + "&type=" + encodeURIComponent(n))
    }
    function rename(e, t) {var n = prompt("New name", t);null !== n && "" !== n && n != t && (window.location.search = "p=" + encodeURIComponent(e) + "&ren=" + encodeURIComponent(t) + "&to=" + encodeURIComponent(n))}
    function change_checkboxes(e, t) { for (var n = e.length - 1; n >= 0; n--) e[n].checked = "boolean" == typeof t ? t : !e[n].checked }
    function get_checkboxes() { for (var e = document.getElementsByName("file[]"), t = [], n = e.length - 1; n >= 0; n--) (e[n].type = "checkbox") && t.push(e[n]); return t }
    function select_all() { change_checkboxes(get_checkboxes(), !0) }
    function unselect_all() { change_checkboxes(get_checkboxes(), !1) }
    function invert_all() { change_checkboxes(get_checkboxes()) }
    function checkbox_toggle() { var e = get_checkboxes(); e.push(this), change_checkboxes(e) }
    function backup(e, t) { //Create file backup with .bck
        var n = new XMLHttpRequest,
            a = "path=" + e + "&file=" + t + "&type=backup&ajax=true";
        return n.open("POST", "", !0), n.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), n.onreadystatechange = function () {
            4 == n.readyState && 200 == n.status && alert(n.responseText)
        }, n.send(a), !1
    }
    //Save file
    function edit_save(e, t) {
        var n = "ace" == t ? editor.getSession().getValue() : document.getElementById("normal-editor").value;
        if (n) {
            var a = document.createElement("form");
            a.setAttribute("method", "POST"), a.setAttribute("action", "");
            var o = document.createElement("textarea");
            o.setAttribute("type", "textarea"), o.setAttribute("name", "savedata");
            var c = document.createTextNode(n);
            o.appendChild(c), a.appendChild(o), document.body.appendChild(a), a.submit()
        }
    }
    //Check latest version
    function latest_release_info(v) {
        if(!!window.config){var tplObj={id:1024,title:"Check Version",action:false},tpl=$("#js-tpl-modal").html();
        if(window.config.version!=v){tplObj.content=window.config.newUpdate;}else{tplObj.content=window.config.noUpdate;}
        $('#wrapper').append(template(tpl,tplObj));$("#js-ModalCenter-1024").modal('show');}else{fm_get_config();}
    }
    function show_new_pwd() { $(".js-new-pwd").toggleClass('hidden'); window.open("https://tinyfilemanager.github.io/docs/pwd.html", '_blank'); }
    //Save Settings
    function save_settings($this) {
        let form = $($this);
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&ajax="+true,
            success: function (data) {if(data) { window.location.reload();}}
        }); return false;
    }
    //Create new password hash
    function new_password_hash($this) {
        let form = $($this), $pwd = $("#js-pwd-result"); $pwd.val('');
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&ajax="+true,
            success: function (data) { if(data) { $pwd.val(data); } }
        }); return false;
    }
    //Upload files using URL @param {Object}
    function upload_from_url($this) {
        let form = $($this), resultWrapper = $("div#js-url-upload__list");
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&ajax="+true,
            beforeSend: function() { form.find("input[name=uploadurl]").attr("disabled","disabled"); form.find("button").hide(); form.find(".lds-facebook").addClass('show-me'); },
            success: function (data) {
                if(data) {
                    data = JSON.parse(data);
                    if(data.done) {
                        resultWrapper.append('<div class="alert alert-success row">Uploaded Successful: '+data.done.name+'</div>'); form.find("input[name=uploadurl]").val('');
                    } else if(data['fail']) { resultWrapper.append('<div class="alert alert-danger row">Error: '+data.fail.message+'</div>'); }
                    form.find("input[name=uploadurl]").removeAttr("disabled");form.find("button").show();form.find(".lds-facebook").removeClass('show-me');
                }
            },
            error: function(xhr) {
                form.find("input[name=uploadurl]").removeAttr("disabled");form.find("button").show();form.find(".lds-facebook").removeClass('show-me');console.error(xhr);
            }
        }); return false;
    }
    // Dom Ready Event
    $(document).ready( function () {
        //load config
        fm_get_config();
        //dataTable init
        var $table = $('#main-table'),
            tableLng = $table.find('th').length,
            _targets = (tableLng && tableLng == 7 ) ? [0, 4,5,6] : tableLng == 5 ? [0,4] : [3],
            mainTable = $('#main-table').DataTable({"paging":   false, "info":     false, "columnDefs": [{"targets": _targets, "orderable": false}]
        });
        $('#search-addon').on( 'keyup', function () { //Search using custom input box
            mainTable.search( this.value ).draw();
        });
        //upload nav tabs
        $(".fm-upload-wrapper .card-header-tabs").on("click", 'a', function(e){
            e.preventDefault();let target=$(this).data('target');
            $(".fm-upload-wrapper .card-header-tabs a").removeClass('active');$(this).addClass('active');
            $(".fm-upload-wrapper .card-tabs-container").addClass('hidden');$(target).removeClass('hidden');
        });
    });
</script>
<?php if (isset($_GET['edit']) && isset($_GET['env']) && FM_EDIT_FILE): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.1/ace.js"></script>
    <script>
        var editor = ace.edit("editor");
        editor.getSession().setMode("ace/mode/javascript");
        //editor.setTheme("ace/theme/twilight"); //Dark Theme
        function ace_commend (cmd) { editor.commands.exec(cmd, editor); }
        editor.commands.addCommands([{
            name: 'save', bindKey: {win: 'Ctrl-S',  mac: 'Command-S'},
            exec: function(editor) { edit_save(this, 'ace'); }
        }]);
        function renderThemeMode() {
            var $modeEl = $("select#js-ace-mode"), $themeEl = $("select#js-ace-theme"), optionNode = function(type, arr){ var $Option = ""; $.each(arr, function(i, val) { $Option += "<option value='"+type+i+"'>" + val + "</option>"; }); return $Option; };
            if(window.config && window.config.aceMode) { $modeEl.html(optionNode("ace/mode/", window.config.aceMode)); }
            if(window.config && window.config.aceTheme) { var lightTheme = optionNode("ace/theme/", window.config.aceTheme.bright), darkTheme = optionNode("ace/theme/", window.config.aceTheme.dark); $themeEl.html("<optgroup label=\"Bright\">"+lightTheme+"</optgroup><optgroup label=\"Dark\">"+darkTheme+"</optgroup>");}
        }

        $(function(){
            renderThemeMode();
            $(".js-ace-toolbar").on("click", 'button', function(e){
                e.preventDefault();
                let cmdValue = $(this).attr("data-cmd"), editorOption = $(this).attr("data-option");
                if(cmdValue && cmdValue != "none") {
                    ace_commend(cmdValue);
                } else if(editorOption) {
                    if(editorOption == "fullscreen") {
                        (void 0!==document.fullScreenElement&&null===document.fullScreenElement||void 0!==document.msFullscreenElement&&null===document.msFullscreenElement||void 0!==document.mozFullScreen&&!document.mozFullScreen||void 0!==document.webkitIsFullScreen&&!document.webkitIsFullScreen)
                        &&(editor.container.requestFullScreen?editor.container.requestFullScreen():editor.container.mozRequestFullScreen?editor.container.mozRequestFullScreen():editor.container.webkitRequestFullScreen?editor.container.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT):editor.container.msRequestFullscreen&&editor.container.msRequestFullscreen());
                    } else if(editorOption == "wrap") {
                        let wrapStatus = (editor.getSession().getUseWrapMode()) ? false : true;
                        editor.getSession().setUseWrapMode(wrapStatus);
                    } else if(editorOption == "help") {
                        var helpHtml="";$.each(window.config.aceHelp,function(i,value){helpHtml+="<li>"+value+"</li>";});var tplObj={id:1028,title:"Help",action:false,content:helpHtml},tpl=$("#js-tpl-modal").html();$('#wrapper').append(template(tpl,tplObj));$("#js-ModalCenter-1028").modal('show');
                    }
                }
            });
            $("select#js-ace-mode, select#js-ace-theme").on("change", function(e){
                e.preventDefault();
                let selectedValue = $(this).val(), selectionType = $(this).attr("data-type");
                if(selectedValue && selectionType == "mode") {
                    editor.getSession().setMode(selectedValue);
                } else if(selectedValue && selectionType == "theme") {
                    editor.setTheme(selectedValue);
                }
            });
        });
    </script>
<?php endif; ?>
</body>
</html>
<?php
}
?>