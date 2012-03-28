<?php
/**
 * File containing pvr500pxDatatypeID datatype definition
 * @copyright Copyright (c) 2012 - Philippe VINCENT-ROYOL. All rights reserved
 * @licence http://www.gnu.org/licenses/gpl-2.0.txt GNU GPLv2
 * @version @@@VERSION@@@
 */
class pvr500pxDatatypeIDType extends eZDataType
{
    const DATA_TYPE_STRING = 'pvr500pxdatatypeid',
          DATA_TYPE_FIELD = 'ContentClass_pvr500px_';

    const CLASSATTRIBUTE_CONSUMMER_KEY_FIELD    = 'data_text1',
          CLASSATTRIBUTE_CONSUMMER_SECRET_FIELD = 'data_text2',
          CLASSATTRIBUTE_ACCESS_TOKEN           = 'data_text3',
          CLASSATTRIBUTE_ACCESS_TOKEN_SECRET    = 'data_text4',
          CLASSATTRIBUTE_DEFAULT_EMPTY          = '';

    /**
     * Constructor
     */
    public function __construct()
    {
        $datatypeLabel = ezpI18n::tr( 'datatypes/pvr500pxdatatype', 'pvr500px datatype' );
        parent::eZDataType( self::DATA_TYPE_STRING, $datatypeLabel, array( 'translation_allowed' => false ) );
    }

    // --------------------------------------
    // Methods concerning the Class attribute
    // --------------------------------------


    /**
     * Sets default values for a new class attribute.
     * @param eZContentClassAttribute $classAttribute
     * @return void
     */
    public function initializeClassAttribute( $classAttribute )
    {
        $ini = eZINI::instance( 'pvr500px.ini' );

        // Default value for consummer key field
        if( !$classAttribute->attribute( self::CLASSATTRIBUTE_CONSUMMER_KEY_FIELD ) )
        {
            $classAttribute->setAttribute( self::CLASSATTRIBUTE_CONSUMMER_KEY_FIELD,
                                           $ini->variable( 'ConsummerSettings', 'ConsummerKey' ) );
        }

        // Default value for consummer secret field
        if( !$classAttribute->attribute( self::CLASSATTRIBUTE_CONSUMMER_SECRET_FIELD ) )
        {
            $classAttribute->setAttribute( self::CLASSATTRIBUTE_CONSUMMER_SECRET_FIELD,
                                           $ini->variable( 'ConsummerSettings', 'ConsummerSecret' ) );
        }

        // Default value for access token field
        if( !$classAttribute->attribute( self::CLASSATTRIBUTE_ACCESS_TOKEN ) )
        {
            $classAttribute->setAttribute( self::CLASSATTRIBUTE_ACCESS_TOKEN,
                                           self::CLASSATTRIBUTE_DEFAULT_EMPTY );
        }

        // Default value for access token secret field
        if( !$classAttribute->attribute( self::CLASSATTRIBUTE_ACCESS_TOKEN_SECRET ) )
        {
            $classAttribute->setAttribute( self::CLASSATTRIBUTE_ACCESS_TOKEN_SECRET,
                                           self::CLASSATTRIBUTE_DEFAULT_EMPTY );
        }
    }

    /**
     * Validates the input from the class definition form concerning this attribute.
     * @param eZHTTPTool $http
     * @param string $base Seems to be always 'ContentClass'
     * @param eZContentClassAttribute $classAttribute
     * @return int eZInputValidator::STATE_ACCEPTED | eZInputValidator::STATE_INVALID | eZInputValidator::STATE_INTERMEDIATE
     */
    public function validateClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        // 4 http post variables to test.
        $consummer_key_field        = self::DATA_TYPE_FIELD . "consummer_key_field_" . $classAttribute->attribute( 'id' );
        $consummer_secret_field     = self::DATA_TYPE_FIELD . "consummer_secret_field_" . $classAttribute->attribute( 'id' );
        $oauth_token_field          = self::DATA_TYPE_FIELD . "oauth_token_field_" . $classAttribute->attribute( 'id' );
        $oauth_token_secret_field   = self::DATA_TYPE_FIELD . "oauth_token_secret_field_" . $classAttribute->attribute( 'id' );

        if( $http->hasPostVariable( $consummer_key_field ) && $http->hasPostVariable( $consummer_secret_field )
            && $http->hasPostVariable( $oauth_token_field ) && $http->hasPostVariable( $oauth_token_secret_field ) )
        {
            //@todo: check connection ?
            return eZInputValidator::STATE_ACCEPTED;
        }
        return eZInputValidator::STATE_INVALID;
    }

    /**
     * Handles the input specific for one attirbute from the class edit interface.
     * @param eZHTTPTool $http
     * @param string $base Seems to be always 'ContentClass'
     * @param eZContentClassAttribute $classAttribute
     * @return void
     */
    public function fetchClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        $consummer_key_field        = self::DATA_TYPE_FIELD . "consummer_key_field_" . $classAttribute->attribute( 'id' );
        $consummer_secret_field     = self::DATA_TYPE_FIELD . "consummer_secret_field_" . $classAttribute->attribute( 'id' );
        $oauth_token_field          = self::DATA_TYPE_FIELD . "oauth_token_field_" . $classAttribute->attribute( 'id' );
        $oauth_token_secret_field   = self::DATA_TYPE_FIELD . "oauth_token_secret_field_" . $classAttribute->attribute( 'id' );

        // Save consummer key
        if( $http->hasPostVariable( $consummer_key_field ) )
        {
            $consummer_key = $http->postVariable( $consummer_key_field );
            $classAttribute->setAttribute( self::CLASSATTRIBUTE_CONSUMMER_KEY_FIELD, $consummer_key );
        }

        // Save consummer secrect
        if( $http->hasPostVariable( $consummer_secret_field ) )
        {
            $consummer_secret = $http->postVariable( $consummer_secret_field );
            $classAttribute->setAttribute( self::CLASSATTRIBUTE_CONSUMMER_SECRET_FIELD, $consummer_secret );
        }

        // Save oauth token
        if( $http->hasPostVariable( $oauth_token_field ) )
        {
            $oauth_token = $http->postVariable( $oauth_token_field );
            $classAttribute->setAttribute( self::CLASSATTRIBUTE_ACCESS_TOKEN, $oauth_token );
        }

        // Save oauth token secret
        if( $http->hasPostVariable( $oauth_token_secret_field ) )
        {
            $oauth_token_secret = $http->postVariable( $oauth_token_secret_field );
            $classAttribute->setAttribute( self::CLASSATTRIBUTE_ACCESS_TOKEN_SECRET, $oauth_token_secret );
        }

    }

    /**
     * Returns the content for the class attribute
     * Result is an associative array :
     *      - consummer_key
     *      - consummer_secret
     *      - oauth_token
     *      - oauth_token_secret
     * @param eZContentClassAttribute $classAttribute
     * @return array
     */
    public function classAttributeContent( $classAttribute )
    {
        $content = array(
            'consummer_key'         => $classAttribute->attribute( self::CLASSATTRIBUTE_CONSUMMER_KEY_FIELD ),
            'consummer_secret'      => $classAttribute->attribute( self::CLASSATTRIBUTE_CONSUMMER_SECRET_FIELD ),
            'oauth_token'           => $classAttribute->attribute( self::CLASSATTRIBUTE_ACCESS_TOKEN ),
            'oauth_token_secret'    => $classAttribute->attribute( self::CLASSATTRIBUTE_ACCESS_TOKEN_SECRET )
        );
        return $content;
    }
}
eZDataType::register(  pvr500pxDatatypeIDType::DATA_TYPE_STRING, 'pvr500pxDatatypeIDType' );