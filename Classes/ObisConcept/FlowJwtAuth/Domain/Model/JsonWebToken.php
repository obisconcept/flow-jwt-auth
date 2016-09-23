<?php

namespace ObisConcept\FlowJwtAuth\Domain\Model;

use \TYPO3\Flow\Annotations as Flow;
use \Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class JsonWebToken {

    /**
     * @var \TYPO3\Flow\Security\Account
     * @Flow\Validate(type="NotEmpty")
     * @ORM\OneToOne(targetEntity="\TYPO3\Flow\Security\Account")
     */
    protected $account;

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=255 })
     * @ORM\Column(length=255)
     */
    protected $jwt;

    /**
     * Get identifier
     *
     * @return string
     */
    public function getId() {

        return $this->Persistence_Object_Identifier;

    }

    /**
     * @return mixed
     */
    public function getAccount() {

        return $this->account;

    }

    /**
     * @param mixed $account
     */
    public function setAccount($account) {

        $this->account = $account;

    }

    /**
     * @return string
     */
    public function getJwt() {

        return $this->jwt;

    }

    /**
     * @param string $jwt
     */
    public function setJwt($jwt) {

        $this->jwt = $jwt;

    }

}