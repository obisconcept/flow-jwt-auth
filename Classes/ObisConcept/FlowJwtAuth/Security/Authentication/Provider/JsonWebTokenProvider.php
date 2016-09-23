<?php

namespace ObisConcept\FlowJwtAuth\Security\Authentication\Provider;

use \TYPO3\Flow\Annotations as Flow;
use \TYPO3\Flow\Security\Authentication\Provider\AbstractProvider;
use \TYPO3\Flow\Security\Authentication\TokenInterface;
use \TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException;
use \ObisConcept\FlowJwtAuth\Security\Authentication\Token\JsonWebToken;

class JsonWebTokenProvider extends AbstractProvider {

    /**
     * @var \TYPO3\Flow\Security\AccountRepository
     * @Flow\Inject
     */
    protected $accountRepository;

    /**
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     * @Flow\Inject
     */
    protected $persistenceManager;

    /**
     * @var \TYPO3\Flow\Http\RequestHandler
     * @Flow\Inject
     */
    protected $requestHandler;

    /**
     * @return array
     */
    public function getTokenClassNames() {

        return [JsonWebToken::class];

    }

    /**
     * @param TokenInterface $authenticationToken
     * @throws UnsupportedAuthenticationTokenException
     * @return void
     */
    public function authenticate(TokenInterface $authenticationToken) {

        if (!($authenticationToken instanceof JsonWebToken)) {
            throw new UnsupportedAuthenticationTokenException('This provider cannot authenticate the given token.', 1217339840);
        }

        /** @var $account \TYPO3\Flow\Security\Account **/
        $account = null;
        $credentials = $authenticationToken->getCredentials();

        if (is_array($credentials) && isset($credentials['jwt']) && $credentials['jwt'] != '') {
            /** @var $jwt \ObisConcept\FlowJwtAuth\Domain\Model\JsonWebToken */
            $jwt = $authenticationToken->getJwt($credentials['jwt']);
            if (is_object($jwt)) {
                $account = $jwt->getAccount();
            }
        }
        if (is_object($account)) {
            if ($decodedJwt = $authenticationToken->checkJwt($jwt->getJwt())) {
                $account->authenticationAttempted(TokenInterface::AUTHENTICATION_SUCCESSFUL);
                $authenticationToken->setAuthenticationStatus(TokenInterface::AUTHENTICATION_SUCCESSFUL);
                $authenticationToken->setAccount($account);
                $authenticationToken->updateJwt($decodedJwt);
            } else {
                $account->authenticationAttempted(TokenInterface::WRONG_CREDENTIALS);
                $authenticationToken->setAuthenticationStatus(TokenInterface::WRONG_CREDENTIALS);
            }
            $this->accountRepository->update($account);
            $this->persistenceManager->whitelistObject($account);
        } elseif ($authenticationToken->getAuthenticationStatus() !== TokenInterface::AUTHENTICATION_SUCCESSFUL) {
            $authenticationToken->setAuthenticationStatus(TokenInterface::NO_CREDENTIALS_GIVEN);
        }

    }

}