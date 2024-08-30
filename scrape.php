<?php
require 'vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\HttpClient\Exception\TransportException;

function scrapeImages($url) {
    $client = new Client();
    try {
        $crawler = $client->request('GET', $url);
    } catch (TransportException $e) {
        return ['error' => 'Failed to connect to the URL. Please check the URL and try again.'];
    }

    $images = $crawler->filter('img')->each(function ($node) {
        return $node->attr('src');
    });

    return $images;
}
?>