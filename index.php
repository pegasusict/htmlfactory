<?php declare( strict_types=1 );
if(PHP_MAJOR_VERSION.PHP_MINOR_VERSION < 73) die("I need at least PHP 7.3 to function properly!!!");
require_once __DIR__ . "/lib/htmlfactory.class.php";

$html = new pegasusict\HtmlFactory();
$html->setSiteTitle ([$html::LANG_EN => "Mattijs' Brython Test Site", $html::LANG_NL => "Mattijs' Brython Test Site" ]);
$siteKeywords = "Html Factory, Proof of Concept, Pegasus ICT Dienstverlening";
//pages
$page  = array_key_exists("page",$_GET)?$_GET['page'] : 0;
$pages = [ 'home', 'contact' ];
if( !array_key_exists( $page,  $pages ) ) $page = 0;
$pageTitles  = [
    [ LANG_EN   => "Welcome"
    , LANG_NL   => "Welkom"
    ]
    , [ LANG_EN   => "Contact Me"
    , LANG_NL => "Neem Contact Op"
    ]
];
$pageContent = [
    [ LANG_EN   => <<<EOT
            Welcome to the Brython test site of Mattijs Snepvangers.
            This is just a small Proof Of Concept.
            EOT
      , LANG_NL => <<<EOT
            Welkom op de Bryton test site van Mattijs Snepvangers.
            Dit is een concept test.
            EOT
    ]
    , [ LANG_EN   => <<<EOT
            Contact Page.
            EOT
        , LANG_NL => <<<EOT
            Contact Pagina.
            EOT
    ]
];

// prepare to set and display some html headers
html::setHeader( "language=$lang", "title=" . $siteTitle[ $lang ] . " ~ " . $pageTitles[ $page ][ $lang ], "keywords=$siteKeywords" );

if( file_exists( __DIR__ . "/favicon.ico" ) ) html::setHeader( "icon=favicon.ico" );
html::setHeader("css=css/style.css");
foreach( [ "brython", "brython_stdlib" ] as $js ) html::setHeader( sprintf( 'js=js/%s.js', $js ) );
html::displayHeader();
html::addComment( $copyRight  );

html::body( "id=body",'onload=brython(1)' );
html::script("py" ,"brython/bind.py");

html::startBlock();
html::div( "class=container" );


html::endBlock();
//html::closetag();
# display copyright
html::div( "style=text-align:center;font-size:80%;padding:10em;", "txt=".$copyRight );
# closes all opened tags
html::finish();