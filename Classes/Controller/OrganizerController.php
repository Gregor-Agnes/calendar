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

/**
 * OrganizerController
 */
class OrganizerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $organizers = $this->organizerRepository->findAll();
        $this->view->assign('organizers', $organizers);
    }

    /**
     * action show
     *
     * @param \Zwo3\Calendar\Domain\Model\Organizer $organizer
     * @return void
     */
    public function showAction(\Zwo3\Calendar\Domain\Model\Organizer $organizer)
    {
        $this->view->assign('organizer', $organizer);
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
