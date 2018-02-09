<?php
namespace Zwo3\Calendar\Service;


use Zwo3\Calendar\Domain\Model\Event;

/**
 * Class CreateRecurrenceFromEvent
 *
 * @package Zwo3\Calendar\Service
 */
class CreateRecurrenceFromEvent {

    /** @var Event */
    var $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

}