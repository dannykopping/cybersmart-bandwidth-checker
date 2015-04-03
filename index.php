<?php
require_once "vendor/autoload.php";

$credentials = require_once "creds.php";

use Goutte\Client;

$client = new Client();
$crawler = $client->request('GET', 'https://www.cybersmart.co.za/logout.cgi');
$form = $crawler->filter('#adslusageloginsubmitbtn')->form();

$crawler = $client->submit($form, array('credential_0' => $credentials['username'], 'credential_1' => $credentials['password']));
$crawler = $client->request('GET', 'https://www.cybersmart.co.za/usage/');

$value = trim($crawler->filter('.statgrid > div')->last()->text());

preg_match('%(.+)\s+([\d\.]+)%', $value, $results);

unset($results[0]);
echo implode(": ", $results).'Gb';
