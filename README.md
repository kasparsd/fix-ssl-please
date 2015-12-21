# Fix SSL for WordPress

Ensure that all assets are loaded using the correct protocol. The plugin won't enforce or redirect to HTTPS.


## Force SSL for WordPres Admin

Simply add the following constant to `wp-config.php`

	define( 'FORCE_SSL_ADMIN', true );


## Author

Kaspars Dambis  
http://kaspars.net
