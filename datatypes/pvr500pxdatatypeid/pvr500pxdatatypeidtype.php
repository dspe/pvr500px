<?php
/**
 * File containing pvr500pxDatatypeID datatype definition
 * @licence http://www.gnu.org/licenses/gpl-2.0.txt GNU GPLv2
 * @version @@@VERSION@@@
 */
class pvr500pxDatatypeIDType extends eZDataType
{
    const DATA_TYPE_STRING= 'pvr500pxdatatypeid';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::eZDataType( self::DATA_TYPE_STRING, '500px datatype' );
    }
}
eZDataType::register(  pvr500pxDatatypeIDType::DATA_TYPE_STRING, 'pvr500pxDatatypeIDType' );