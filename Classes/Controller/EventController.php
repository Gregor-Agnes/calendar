<?php
namespace Zwo3\Calendar\Controller;

/***
 *
 * This file is part of the "calendar" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Gregor Agnes <ga@zwo3.de>, zwo3
 *
 ***/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Zwo3\Calendar\Service\RecurrenceGenerator;

/**
 * EventController
 */
class EventController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * eventRepository
     *
     * @var \Zwo3\Calendar\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository = null;

    /**
     * objectManager
     *
     *
     */
    protected $objectManager = null;


    protected function initializeAction()
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {

        //DebuggerUtility::var_dump($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']);
        $events = $this->eventRepository->findAll(true, 200, true);





        $this->view->assign('events', $events);
    }

    /**
     * action show
     *
     * @param \Zwo3\Calendar\Domain\Model\Event $event
     * @return void
     */
    public function showAction(\Zwo3\Calendar\Domain\Model\Event $event)
    {
        $this->view->assign('event', $event);
    }

    /**
     * action search
     *
     * @return void
     */
    public function searchAction()
    {

    }

}
