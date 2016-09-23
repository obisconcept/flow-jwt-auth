<?php

namespace \ObisConcept\FlowJwtAuth\Security\Authentication\Provider;

use \TYPO3\Flow\Security\Authentication\Provider\AbstractProvider;
use \TYPO3\Flow\Security\Authentication\TokenInterface;

class JsonWebToken extends AbstractProvider {

    public function canAuthenticate(TokenInterface $authenticationToken) {

        // @ToDo Check authentication and update provider token
        if ($authenticationToken->getAuthenticationProviderName() === $this->name) {
            return true;
        } else {
            return false;
        }

    }

}