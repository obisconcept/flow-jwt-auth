<?php

namespace ObisConcept\FlowJwtAuth\Security\Authentication\Token;

use \TYPO3\Flow\Annotations as Flow;
use \TYPO3\Flow\Security\Authentication\Token\AbstractToken;
use \TYPO3\Flow\Security\Authentication\Token\SessionlessTokenInterface;
use \TYPO3\Flow\Mvc\ActionRequest;
use \Firebase\JWT\JWT;

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
     * @var \ObisConcept\FlowJwtAuth\Domain\Repository\JsonWebTokenRepository
     * @Flow\Inject
     */
    protected $jwtRepository;

    /**
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     * @Flow\Inject
     */
    protected $persistenceManager;

    /**
     * @var array
     * @Flow\Transient
     */
    protected $credentials = ['jwt' => ''];

    /**
     * @param ActionRequest $actionRequest
     * @return void
     */
    public function updateCredentials(ActionRequest $actionRequest) {

        $httpRequest = $actionRequest->getHttpRequest();
        var_dump($httpRequest->getCookies());

        $encodedJwt = '';
        if (isset($httpRequest->getCookies()['token'])) {
            $encodedJwt = $httpRequest->getCookies()['token'];
        }

        if (!empty($encodedJwt)) {
            $this->credentials['jwt'] = $encodedJwt;
            $this->setAuthenticationStatus(self::AUTHENTICATION_NEEDED);
        }

    }

    /**
     * @param string $encodedJwt
     * @return bool
     */
    public function checkJwt($encodedJwt = '') {

        try {
            $decodedJwt = JWT::decode($encodedJwt, $this->secret, array('HS256'));
            return $decodedJwt;
        } catch (\Exceoption $error) {
            return false;
        }

    }

    /**
     * @param string $decodedJwt
     * @param \ObisConcept\FlowJwtAuth\Domain\Model\JsonWebToken $jwt
     * @return void
     */
    public function updateJwt($decodedJwt = '', $jwt = null) {

        if (!empty($decodedJwt) && $jwt) {
            $decodedJwt = (array) $decodedJwt;
            $decodedJwt['exp'] = time() + 600;
            $encodedJwt = JWT::encode($decodedJwt, $this->secret);
            $jwt->setJwt($encodedJwt);

            $this->jwtRepository->update($jwt);
            $this->persistenceManager->whitelistObject($jwt);
            setcookie('token', $encodedJwt);
        }

    }

    /**
     * @param string $jwt
     * @return \ObisConcept\FlowJwtAuth\Domain\Model\JsonWebToken
     */
    public function getJwt($jwt = '') {

        return $this->jwtRepository->findByJwt($jwt);

    }

}