<?php

namespace ObisConcept\FlowJwtAuth\Security\Authentication\Provider;

use \TYPO3\Flow\Security\Authentication\Provider\AbstractProvider;
use \TYPO3\Flow\Security\Authentication\TokenInterface;
use \ObisConcept\FlowJwtAuth\Security\Authentication\Token\JsonWebToken;

class JsonWebTokenProvider extends AbstractProvider {

    public function getTokenClassNames() {

        return [JsonWebToken::class];

    }

    public function authenticate(TokenInterface $authenticationToken) {

        // @ToDo Authenticate with JWT token

    }

}