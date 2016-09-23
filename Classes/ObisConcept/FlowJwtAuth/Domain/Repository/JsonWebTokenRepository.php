<?php

namespace ObisConcept\FlowJwtAuth\Domain\Repository;

use \TYPO3\Flow\Annotations as Flow;
use \TYPO3\Flow\Persistence\Doctrine\Repository;

/**
 * @Flow\Scope("singleton")
 */
class JsonWebTokenRepository extends Repository {}