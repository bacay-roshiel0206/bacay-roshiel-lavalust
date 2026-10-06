<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Enable/Disable API Helper
|--------------------------------------------------------------------------
*/

$config['api_helper_enabled'] = TRUE;

$config['payload_token_expiration'] = 3600;

$config['refresh_token_expiration'] = 604800;

$config['jwt_secret'] = 'cbTsnJDxCodakDxh4M3qd5Sn3Kd2cYCDp4MEu0DAPxx';

$config['refresh_token_key'] = '0bNvxjPFJ6dhi1Ttf7AStp95zUcd1iy94mjblklwfPs';

$config['allow_origin'] = [
    'http://localhost:5173',
    'http://127.0.0.1:5173',
    'https://product-frontend-xwhk.onrender.com'
];

$config['refresh_token_table'] = 'refresh_tokens';

$config['jwt_issuer'] = 'your-app';

$config['jwt_audience'] = 'your-app-clients';

$config['rate_limit_enabled'] = true;

$config['rate_limit_requests'] = 60;

$config['rate_limit_seconds'] = 60;
