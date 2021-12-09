<?php

namespace App\Service;

use App\Entity\User;
use App\Boot;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class UserService
{
    private EntityManager $entityManager;
    private EntityRepository $userRepository;
    private HttpClientInterface $httpClient;

    /**
     * @throws ORMException
     */
    public function __construct()
    {
        $this->entityManager = Boot::$entityManager;
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->httpClient = HttpClient::create();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function run($url)
    {
        $response = $this->httpClient->request('GET', $url);
        foreach ($response->toArray() as $item) {
            try {
                $this->flusher($item);
            } catch (OptimisticLockException | ORMException $e) {
            }
        }
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function flusher(array $item)
    {
        if (!$user = $this->userRepository->findOneBy(['githubId' => $item['id']])) {
            $user = new User();
            $user->setGithubId($item['id']);
            $user->setGithubLogin($item['login']);
            $this->entityManager->persist($user);
        }
        $user->setGithubLogin($item['login']);
        $this->entityManager->flush();
    }
}
