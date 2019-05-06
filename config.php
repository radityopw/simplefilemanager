<?php
//Default Configuration
$CONFIG = '{"lang":"en","error_reporting":false,"show_hidden":false}';

// Enable highlight.js (https://highlightjs.org/) on view's page
$use_highlightjs = true;

// highlight.js style
$highlightjs_style = 'vs';

// Enable ace.js (https://ace.c9.io/) on view's page
$edit_files = true;

// Default timezone for date() and time() - http://php.net/manual/en/timezones.php
$default_timezone = 'Etc/UTC'; // UTC

// Root path for file manager
$root_path = $_SERVER['DOCUMENT_ROOT'];

// Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
// Will not working if $root_path will be outside of server document root
$root_url = '';

// Server hostname. Can set manually if wrong
$http_host = $_SERVER['HTTP_HOST'];

// input encoding for iconv
$iconv_input_encoding = 'UTF-8';

// date() format for file modification date
$datetime_format = 'd.m.y H:i';

// allowed file extensions for upload and rename
$allowed_extensions = ''; // 'gif,png,jpg'

// Array of files and folders excluded from listing
$GLOBALS['exclude_items'] = array();

// Google Docs Viewer
$GLOBALS['online_viewer'] = true;

//Sticky Nav bar
$sticky_navbar = true;

//max upload file size
define('MAX_UPLOAD_SIZE', '2048');