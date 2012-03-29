<?php

$module = $Params["Module"];
$classAttributeId = $Params["ClassAttributeId"];

$ini    = eZIni::instance( 'pvr500px.ini' );
$http   = eZHTTPTool::instance();
$ezuri  = eZURI::instance();
$href   = "/500pxauth/callback/" . $classAttributeId;

// Get consummer informations
$consummer_key      = $ini->variable( 'ConsummerSettings', 'ConsummerKey' );
$consummer_secret   = $ini->variable( 'ConsummerSettings', 'ConsummerSecret' );

$ezuri->transformURI( $href, false, "full" );

// Established a first connection.
$connection = new pvr500pxOAuth($consummer_key, $consummer_secret);

$request_token = $connection->getRequestToken( $href );

$oauth_token = $request_token['oauth_token'];
$oauth_token_secret = $request_token['oauth_token_secret'];

$http->setSessionVariable( 'oauth_token', $oauth_token );
$http->setSessionVariable( 'oauth_token_secret', $oauth_token_secret );


if( $connection->http_code == 200 )
{
    $url = $connection->getAuthorizeURL( $oauth_token );
    header('Location: ' . $url );
}
else
{
    echo "error !";
}

?>