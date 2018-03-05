<?php

namespace Zwo3\Calendar\Domain\Repository;

/***
 * This file is part of the "calendar" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2018 Gregor Agnes <ga@zwo3.de>, zwo3
 ***/

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * The repository for Events
 */
class ExceptionEventRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{


    /**
     * @var array
     */
    protected $defaultOrderings = [
        'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    ];

    public function initializeObject()
    {
        // Einstellungen laden
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);

        // Einstellungen bearbeiten
        #$querySettings->setSomething();

        $querySettings->setRespectStoragePage(false);

        // Einstellungen als Default setzen
        # $this->setDefaultQuerySettings($querySettings);
    }





}
