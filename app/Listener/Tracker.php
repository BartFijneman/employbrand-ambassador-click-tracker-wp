<?php

namespace EmploybrandAmbassador\Listener;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;


class Tracker
{
    public static function register()
    {
        /*
         * Only allow the front page
         */
        if(strtok($_SERVER["REQUEST_URI"], '?') == '/') {

            /*
             * Tracking active
             */
            if(isset($_GET['eb_ambassador_tracking']) && isset($_GET['id']) && isset($_GET['token']) && isset($_GET['company'])) {

                $id = $_GET['id'];
                $token = $_GET['token'];
                $company = $_GET['company'];

                $apiUrl = 'https://api.ambassador.employbrand.app/ambassador/post-forward/' . $id . '/' . $token . '?company=' . $company;

                try {
                    $cookieJar = CookieJar::fromArray([
                        'unique-link-' . $id => $_COOKIE['eb-ambassador-tracked-' . $id]
                    ], 'api.ambassador.employbrand.app');

                    $client = new Client([
                        'cookies' => $cookieJar
                    ]);
                    $res = $client->request('GET', $apiUrl, [
                        'headers' => [
                            'User-Agent' => $_SERVER['HTTP_USER_AGENT'],
                        ]
                    ]);

                    setcookie('eb-ambassador-tracked-' . $id, true, time() + 3600 * 24 * 365);

                    exit($res->getBody());
                }
                catch (\Exception $exception) {
                    header("Location: " . site_url());
                }
            }
        }
    }

}
