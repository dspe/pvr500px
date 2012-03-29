<?php

$module = $Params['Module'];
$classAttributeId = $Params['ClassAttributeId'];

$http = eZHTTPTool::instance();
$ini  = eZINI::instance( 'pvr500px.ini' );
$tpl  = eZTemplate::factory();

/**
 * If variables session exists ...
 */
if( $http->hasSessionVariable( 'oauth_token' ) && $http->hasSessionVariable( 'oauth_token_secret' ))
{
    // get current consummer key ...
    $consummer_key      = $ini->variable( 'ConsummerSettings', 'ConsummerKey' );
    $consummer_secret   = $ini->variable( 'ConsummerSettings', 'ConsummerSecret' );

    // get temporary token, token secret and verifier.
    $oauth_token        = $http->sessionVariable( 'oauth_token' );
    $oauth_token_secret = $http->sessionVariable( 'oauth_token_secret' );
    $oauth_verifier     = $http->getVariable( 'oauth_verifier' );

    // Established a new connection
    $connection     = new pvr500pxOAuth( $consummer_key, $consummer_secret, $oauth_token, $oauth_token_secret );
    $access_token   = $connection->getAccessToken( $oauth_verifier );

    // Finaly save real tokens
    $oauth_token        = $access_token['oauth_token'];
    $oauth_token_secret = $access_token['oauth_token_secret'];

    $tpl->setVariable( 'token', $oauth_token );
    $tpl->setVariable( 'token_secret', $oauth_token_secret );
    $tpl->setVariable( 'classattribute_id', $classAttributeId );
}
else
{
    eZDebug::writeError( "500px callback, can't find token and token secret session..." );
    $tpl->setVariable( 'error', "Could not find token and token secret session variables" );
}

$Result = array();
$Result['content']      = $tpl->fetch( 'design:500pxauth/callback.tpl' );
$Result['pagelayout']   = 'light_pagelayout.tpl';
?>