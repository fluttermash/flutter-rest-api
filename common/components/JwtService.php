<?php

namespace common\components;

include_once '../../php-jwt-main/src/BeforeValidException.php';
include_once '../../php-jwt-main/src/ExpiredException.php';
include_once '../../php-jwt-main/src/SignatureInvalidException.php';
include_once '../../php-jwt-main/src/JWT.php';

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Description of JwtService.php
 *
 *
 */
class JwtService extends Component {


    public static $privateKey;


    public function __construct($config = []) {

        self::$privateKey = $config['privateKey'];
    }

    
    public function encodeJWT($payload)
    {
        $jwt = \Firebase\JWT\JWT::encode($payload, self::$privateKey);
        return $jwt;
    }
    
    public function decodeJWT()
    {
        $jwt = self::getBearerToken();
        $jwtData = \Firebase\JWT\JWT::decode($jwt, self::$privateKey, array('HS256'));
      
      return (array)$jwtData;
              
    }
    
    
         public function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
   
   public function getBearerToken() {
    $headers = self::getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}
    
    
    
    

}