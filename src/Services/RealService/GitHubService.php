<?php
namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GitHubService {
    public function connectToGithub() {
        $httpClient = new HttpClientInterface();
        $response = $httpClient->request('GET',
        'https://api.github.com/repos/symfony/symfony-docs');
        $statusCode = $response->getStatusCode();
        return $statusCode;
    }
}

?>
