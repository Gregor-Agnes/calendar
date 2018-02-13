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

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $events = $this->eventRepository->findAll();


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
