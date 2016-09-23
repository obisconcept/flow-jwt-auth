<?php

namespace ObisConcept\FlowJwtAuth\Security\Authentication\Token;

use \TYPO3\Flow\Annotations as Flow;
use \TYPO3\Flow\Security\Authentication\Token\AbstractToken;
use \TYPO3\Flow\Security\Authentication\Token\SessionlessTokenInterface;
use \TYPO3\Flow\Mvc\ActionRequest;

class JsonWebToken extends AbstractToken implements SessionlessTokenInterface {

    /**
     * @var string
     * @Flow\Inject(setting="security.iss")
     */
    protected $iss;

    /**
     * @var string
     * @Flow\Inject(setting="security.secret")
     */
    protected $secret;

    /**
     * @var array
     * @Flow\Transient
     */
    protected $credentials = ['jwt' => ''];

    public function updateCredentials(ActionRequest $actionRequest) {

        // @ToDo Set credentials (JWT)
        $payload = [
            'iat'   => time(),
            'jti'   => 'JWT entity identifier',
            'iss'   => $this->iss,
            'exp'   => time() + 600,
            'data'  => [
                'accountIdentifier'    => 'Account entity identifier'
            ]
        ];

    }

}