<?php

namespace Agorate\DeeplTranslateBundle\Service;

use Pimcore\Model\WebsiteSetting;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeeplService
{
    private HttpClientInterface $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function translate(?string $text, string $targetLocale): ?string
    {
        if (is_null($text)) {
            return null;
        }

        $authKey = WebsiteSetting::getByName("deepl_auth_key") ? WebsiteSetting::getByName("deepl_auth_key")->getData() : null;

        $response = $this->httpClient->request('POST', "https://api.deepl.com/v2/translate", [
            'body' => [
                'auth_key' => $authKey,
                'text' => $text,
                'target_lang' => substr($targetLocale, 0, 2)
            ]
        ]);

        $parsedResponse = json_decode($response->getContent());

        return $parsedResponse->translations[0]->text;
    }
}