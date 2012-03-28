<div class="block">
    <fieldset>
        <legend>
            {"Reference field for 500px Oauth"|i18n( "design/standard/class/datatype/pvr500px" )}
        </legend>

        <label for="ContentClass_pvr500px_consummer_key_field_{$class_attribute.id}">
            {"Enter consummer key"|i18n( "design/standard/class/datatype/pvr500px" )}
        </label>

        <input type="text" size="60"
                name="ContentClass_pvr500px_consummer_key_field_{$class_attribute.id}"
                id="ContentClass_pvr500px_consummer_key_field_{$class_attribute.id}"
                value="{$class_attribute.data_text1}" />

        <br /><br />

        <label for="ContentClass_pvr500px_consummer_secret_field_{$class_attribute.id}">
            {"Enter consummer secret"|i18n( "design/standard/class/datatype/pvr500px" )}
        </label>

        <input type="text" size="60"
                name="ContentClass_pvr500px_consummer_secret_field_{$class_attribute.id}"
                id="ContentClass_pvr500px_consummer_secret_field_{$class_attribute.id}"
                value="{$class_attribute.data_text2}" />

        <input type="button"
               id="ContentClass_pvr500px_button_token_{$class_attribute.id}"
               name="ContentClass_pvr500px_button_token_{$class_attribute.id}"
               value="{"Get access token"|i18n( 'design/standard/class/datatype/pvr500px' )}" />
        <i>{"Click on button will open a popup"|i18n( 'design/standard/class/datatype/pvr500px' )}</i>

        <script type="text/javascript">
                $(document).ready( function() {ldelim}
                    $("#ContentClass_pvr500px_button_token_{$class_attribute.id}").popupWindow({ldelim}
                        windowURL: '{concat( "/500pxauth/connect/", $class_attribute.id )|ezurl( no )}',
                        windowName: 'oauth',
                        centerScreen:1,
                        height:500,
                        width:800,
                    {rdelim});

                    var verif=0;
                    $("#ContentClass_pvr500px_consummer_key_field_{$class_attribute.id}, #ContentClass_pvr500px_consummer_secret_field_{$class_attribute.id}").click( function() {ldelim}
                        if( verif == 0 )
                        {ldelim}
                            $("#ContentClass_pvr500px_consummer_key_field_{$class_attribute.id}").val('');
                            $("#ContentClass_pvr500px_consummer_secret_field_{$class_attribute.id}").val('');
                            $("#ContentClass_pvr500px_consummer_oauth_token_field_{$class_attribute.id}").val('');
                            $("#ContentClass_pvr500px_consummer_oauth_token_secret_field_{$class_attribute.id}").val('');
                            verif=1;
                        {rdelim}
                    {rdelim});
                {rdelim});
        </script>

        <br /><br />

        <label for="ContentClass_pvr500px_oauth_token_field_{$class_attribute.id}">
            {"Oauth token received"|i18n( "design/standard/class/datatype/pvr500px" )}
        </label>

        <input type="text" size="60"
                name="ContentClass_pvr500px_oauth_token_field_{$class_attribute.id}"
                id="ContentClass_pvr500px_oauth_token_field_{$class_attribute.id}"
                value="{$class_attribute.data_text3}" readonly />


        <label for="ContentClass_pvr500px_oauth_token_secret_field_{$class_ttribute.id}">
            {"Oauth token secret received"|i18n( "design/standard/class/datatype/pvr500px" )}
        </label>

        <input type="text" size="60"
                name="ContentClass_pvr500px_oauth_token_secret_field_{$class_attribute.id}"
                id="ContentClass_pvr500px_oauth_token_secret_field_{$class_attribute.id}"
                value="{$class_attribute.data_text4}" readonly />
</div>