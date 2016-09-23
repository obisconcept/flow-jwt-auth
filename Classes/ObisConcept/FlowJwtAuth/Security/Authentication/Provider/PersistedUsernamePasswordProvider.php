<?php

namespace ObisConcept\FlowJwtAuth\Security\Authentication\Provider;

use \TYPO3\Flow\Security\Authentication\Provider\PersistedUsernamePasswordProvider as FlowPersistedUsernamePasswordProvider;
use \TYPO3\Flow\Security\Authentication\Token\UsernamePassword;
use \TYPO3\Flow\Security\Authentication\TokenInterface;
use \TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException;

class PersistedUsernamePasswordProvider extends FlowPersistedUsernamePasswordProvider {

    /**
     * An authentication provider that authenticates
     * TYPO3\Flow\Security\Authentication\Token\UsernamePassword tokens.
     * The accounts with jwt are stored in the Content Repository.
     */
    public function authenticate(TokenInterface $authenticationToken) {

        parent::authenticate($authenticationToken);

        // @ToDo Save or update JWT if authentication is successful

    }

}