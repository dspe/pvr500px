{if is_set( $token )|and( is_set( $token_secret ) )}
    <script type="text/javascript">
        $( document ).ready( function() {ldelim}
            var openerDiv = window.opener.document;
            if( openerDiv != null )
            {ldelim}
                $( "#ContentClass_pvr500px_oauth_token_field_{$classattribute_id}", window.opener.document ).val( '{$token}' );
                $( "#ContentClass_pvr500px_oauth_token_secret_field_{$classattribute_id}", window.opener.document ).val( '{$token_secret}' );

                window.close();
            {rdelim}
        {rdelim});
    </script>
{else}
    {"Something's wrong happend"|i18n( 'standard/templates/500pxauth/callback' )}
    {if is_set( $error )}
        {$error}
    {/if} 
{/if}