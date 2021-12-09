<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $githubId;

    /**
     * @ORM\Column(type="string")
     */
    protected $githubLogin;

    public function getId()
    {
        return $this->id;
    }

    public function getGithubId()
    {
        return $this->githubId;
    }

    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;
    }

    public function getGithubLogin()
    {
        return $this->githubLogin;
    }

    public function setGithubLogin($githubLogin)
    {
        $this->githubLogin = $githubLogin;
    }

}
