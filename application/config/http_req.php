<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  HTTP REQUEST HELPER CONFIG
*
* Version: 0.0.1
*
* Author: Dian Mukti Wibowo
*		  Kamal Miftahul Amin
*   	  Iwan Firmawan      
*
* Added Awesomeness: https://github.com/guzzle/
*
* Created:  22.02.2019
*
* Description:  Di buat untuk kebutuhan penanganan HTTP request Stockraken
* Requirements: PHP5 or above
*
*/

// about author
$config['version']				= 'Alpha.0.5';
$config['author']['company']	= 'clickoding';
$config['author']['helper']		= 'onyetcorp; unirest;';

// curl auth method
$config['curlauth']['basic']	= CURLAUTH_BASIC;
$config['curlauth']['digest']	= CURLAUTH_DIGEST;
// $config['curlauth']['bearer']	= CURLAUTH_BEARER;
$config['curlauth']['digest_ie']= CURLAUTH_DIGEST_IE;
$config['curlauth']['negotiate']= CURLAUTH_NEGOTIATE;
$config['curlauth']['ntlm']		= CURLAUTH_NTLM;
$config['curlauth']['ntlm_wb']	= CURLAUTH_NTLM_WB;
$config['curlauth']['any']		= CURLAUTH_ANY;
$config['curlauth']['any_safe']	= CURLAUTH_ANYSAFE;
$config['curlauth']['only']		= CURLAUTH_ONLY;

// method request
// RFC7231
$config['method']['get']		= 'GET';
$config['method']['head']		= 'HEAD';
$config['method']['post']		= 'POST';
$config['method']['put']		= 'PUT';
$config['method']['delete']		= 'DELETE';
$config['method']['connect']	= 'CONNECT';
$config['method']['options']	= 'OPTIONS';
$config['method']['trace']		= 'TRACE';
// RFC3253
$config['method']['baseline']	= 'BASELINE';
// RFC2068
$config['method']['link']		= 'LINK';
$config['method']['unlink']		= 'UNLINK';
// RFC3253
$config['method']['merge']		= 'MERGE';
$config['method']['basecontrol']= 'BASELINE-CONTROL';
$config['method']['mkactivity']	= 'MKACTIVITY';
$config['method']['vercontrol']	= 'VERSION-CONTROL';
$config['method']['report']		= 'REPORT';
$config['method']['checkout']	= 'CHECKOUT';
$config['method']['checkin']	= 'CHECKIN';
$config['method']['uncheckout']	= 'UNCHECKOUT';
$config['method']['mkworkspace']= 'MKWORKSPACE';
$config['method']['update']		= 'UPDATE';
$config['method']['label']		= 'LABEL';
// RFC3648
$config['method']['orderpath']	= 'ORDERPATCH';
// RFC3744
$config['method']['acl']		= 'ACL';
// RFC4437
$config['method']['mkredirect']	= 'MKREDIRECTREF';
$config['method']['upredirect']	= 'UPDATEREDIRECTREF';
// RFC4791
$config['method']['calendar']	= 'MKCALENDAR';
// RFC4918
$config['method']['propfind']	= 'PROPFIND';
$config['method']['lock']		= 'LOCK';
$config['method']['unlock']		= 'UNLOCK';
$config['method']['proppath']	= 'PROPPATCH';
$config['method']['mkcol']		= 'MKCOL';
$config['method']['copy']		= 'COPY';
$config['method']['move']		= 'MOVE';
// RFC5323
$config['method']['search']		= 'SEARCH';
// RFC5789
$config['method']['patch']		= 'PATCH';
// RFC5842
$config['method']['bind']		= 'BIND';
$config['method']['unbind']		= 'UNBIND';
$config['method']['rebind']		= 'REBIND';
