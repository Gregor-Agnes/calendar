<?php
namespace Zwo3\Calendar\Domain\Model;

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

use Carbon\Carbon;
use DateTime;

/**
 * Event
 */
class Event extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * uid
     *
     * @var int
     * @validate NotEmpty
     */
    protected $uid;

    /**
     * cruser_id
     *
     * @var int
     * @validate NotEmpty
     */
    protected $cruserId;

    /**
     * crdate
     *
     * @var string
     * @validate NotEmpty
     */
    protected $crdate;

    /**
     * tstamp
     *
     * @var string
     * @validate NotEmpty
     */
    protected $tstamp;

    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * description
     *
     * @var string
     * @validate NotEmpty
     */
    protected $description = '';

    /** @var string */
    protected $freq = '';
    /** @var int */
    protected $until;
    /** @var int */
    protected $cnt;

    /** @var string */
    protected $byday;
    /** @var string */
    protected $bymonthday;
    /** @var string */
    protected $bymonth;

    /** @var int */
    protected $intrval;

    /** @var string */
    protected $rdate;

    /** @var string */
    protected $rdateType;

    /** @var int */
    protected $allday;

    /** @var string */
    protected $timezone;

    /** @var int */
    protected $calendarId;

    /** @var int */
    protected $categoryId;

    /** @var int */
    protected $organizerId;

    /** @var int */
    protected $locationId;

    /** @var int */
    protected $organizerPid;

    /** @var string */
    protected $organizerLink;

    /** @var string */
    protected $location;

    /** @var int */
    protected $locationPid;

    /** @var string */
    protected $locationLink;

    /** @var string */
    protected $teaser;

    /** @var int */
    protected $monitorCnt;

    /** @var int */
    protected $exceptionCnt;

    /** @var int */
    protected $feCruserId;

    /** @var int */
    protected $feCrgroupId;

    /** @var int */
    protected $sharedUserCnt;

    /** @var int */
    protected $type;

    /** @var int */
    protected $page;

    /** @var string */
    protected $extUrl;

    /** @var int */
    protected $isTemp;

    /** @var string */
    protected $icsUid;

    /** @var string */
    protected $image;

    /** @var string */
    protected $imagecaption;

    /** @var string */
    protected $imagealttext;

    /** @var string */
    protected $imagetitletext;

    /** @var string */
    protected $attachment;

    /** @var string */
    protected $attachmentcaption;

    /** @var int */
    protected $refEventId;

    /** @var int */
    protected $sendInvitation;

    /** @var string */
    protected $attendee;

    /** @var string */
    protected $status;

    /** @var int */
    protected $priority;

    /** @var int */
    protected $completed;

    /** @var int */
    protected $noAutoPb;

    /** @var string */
    protected $txZ3calfieldsFees;

    /** @var string */
    protected $txZ3calfieldsContact;

    /** @var int */
    protected $deviation;



    /** @var int */
    protected $categories;



    /** @var int */
    protected $sorting;

    /** @var string */
    protected $start;

    /** @var string */
    protected $stop;

    /**
     * organizer
     *
     * @var \Zwo3\Calendar\Domain\Model\Organizer
     * @lazy
     */
    protected $organizer = null;

    /**
     * calendar
     *
     * @var \Zwo3\Calendar\Domain\Model\Calendar
     * @lazy
     */
    protected $calendar = null;


    /**
     * category
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Test1\Domain\Model\Category>
     */
    protected $category = null;


    #/** @var int */
    #protected $exception_event_group;

    /**
     * exceptionEventGroups
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEventGroup>
     */
    protected $exceptionEventGroup = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->exceptionEventGroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->category = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the organizer
     *
     * @return \Zwo3\Calendar\Domain\Model\Organizer $organizer
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * Sets the organizer
     *
     * @param \Zwo3\Calendar\Domain\Model\Organizer|null $organizer
     * @return void
     */
    public function setOrganizer(\Zwo3\Calendar\Domain\Model\Organizer $organizer = null)
    {
        $this->organizer = $organizer;
    }

    /**
     * Adds a ExceptionEventGroup
     *
     * @param \Zwo3\Calendar\Domain\Model\ExceptionEventGroup $exceptionEventGroup
     * @return void
     */
    public function addExceptionEventGroup(\Zwo3\Calendar\Domain\Model\ExceptionEventGroup $exceptionEventGroup)
    {
        $this->exceptionEventGroup->attach($exceptionEventGroup);
    }

    /**
     * Removes a ExceptionEventGroup
     *
     * @param \Zwo3\Calendar\Domain\Model\ExceptionEventGroup $exceptionEventGroupToRemove The ExceptionEventGroup to be removed
     * @return void
     */
    public function removeExceptionEventGroup(\Zwo3\Calendar\Domain\Model\ExceptionEventGroup $exceptionEventGroupToRemove)
    {
        $this->exceptionEventGroup->detach($exceptionEventGroupToRemove);
    }

    /**
     * Returns the exceptionEventGroup
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEventGroup> $exceptionEventGroups
     */
    public function getExceptionEventGroup()
    {
        return $this->exceptionEventGroup;
    }

    /**
     * Sets the exceptionEventGroups
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zwo3\Calendar\Domain\Model\ExceptionEventGroup> $exceptionEventGroup
     * @return void
     */
    public function setExceptionEventGroup(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $exceptionEventGroup)
    {
        $this->exceptionEventGroup = $exceptionEventGroup;
    }

    /**
     * @return string|null
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * @param string $stop
     */
    public function setStop(string $stop): void
    {
        $this->stop = $stop;
    }

    /**
     * @return string|null
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param string $start
     */
    public function setStart(string $start): void
    {
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }


    /**
     * @return string
     */
    public function getFreq(): string
    {
        return $this->freq;
    }

    /**
     * @param string $freq
     */
    public function setFreq(string $freq): void
    {
        $this->freq = $freq;
    }

    /**
     * @return int
     */
    public function getUntil(): int
    {
        return $this->until;
    }

    /**
     * @param int $until
     */
    public function setUntil(int $until): void
    {
        $this->until = $until;
    }

    /**
     * @return int
     */
    public function getCnt(): int
    {
        return $this->cnt;
    }

    /**
     * @param int $cnt
     */
    public function setCnt(int $cnt): void
    {
        $this->cnt = $cnt;
    }

    /**
     * @return string
     */
    public function getByday(): string
    {
        return $this->byday;
    }

    /**
     * @param string $byday
     */
    public function setByday(string $byday): void
    {
        $this->byday = $byday;
    }

    /**
     * @return string
     */
    public function getBymonthday(): string
    {
        return $this->bymonthday;
    }

    /**
     * @param string $bymonthday
     */
    public function setBymonthday(string $bymonthday): void
    {
        $this->bymonthday = $bymonthday;
    }

    /**
     * @return string
     */
    public function getBymonth(): string
    {
        return $this->bymonth;
    }

    /**
     * @param string $bymonth
     */
    public function setBymonth(string $bymonth): void
    {
        $this->bymonth = $bymonth;
    }

    /**
     * @return int
     */
    public function getIntrval(): int
    {
        return $this->intrval;
    }

    /**
     * @param int $intrval
     */
    public function setIntrval(int $intrval): void
    {
        $this->intrval = $intrval;
    }

    /**
     * @return string
     */
    public function getRdate(): string
    {
        return $this->rdate;
    }

    /**
     * @param string $rdate
     */
    public function setRdate(string $rdate): void
    {
        $this->rdate = $rdate;
    }

    /**
     * @return string
     */
    public function getRdateType(): string
    {
        return $this->rdate_type;
    }

    /**
     * @param string $rdate_type
     */
    public function setRdateType(string $rdate_type): void
    {
        $this->rdate_type = $rdate_type;
    }

    /**
     * @return mixed
     */
    public function getAllday()
    {
        return $this->allday;
    }

    /**
     * @param mixed $allday
     */
    public function setAllday($allday): void
    {
        $this->allday = $allday;
    }

    /**
     * @return int
     */
    public function getCalendarId(): int
    {
        return $this->calendar_id;
    }

    /**
     * @param int $calendar_id
     */
    public function setCalendarId(int $calendar_id): void
    {
        $this->calendar_id = $calendar_id;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return string
     */
    public function getOrganizerLink(): string
    {
        return $this->organizer_link;
    }

    /**
     * @param string $organizer_link
     */
    public function setOrganizerLink(string $organizer_link): void
    {
        $this->organizer_link = $organizer_link;
    }

    /**
     * @return int
     */
    public function getOrganizerId(): int
    {
        return $this->organizerId;
    }

    /**
     * @param int $organizerId
     */
    public function setOrganizerId(int $organizerId): void
    {
        $this->organizerId = $organizerId;
    }

    /**
     * @return int
     */
    public function getLocationId(): int
    {
        return $this->locationId;
    }

    /**
     * @param int $locationId
     */
    public function setLocationId(int $locationId): void
    {
        $this->locationId = $locationId;
    }

    /**
     * @return int
     */
    public function getOrganizerPid(): int
    {
        return $this->organizerPid;
    }

    /**
     * @param int $organizerPid
     */
    public function setOrganizerPid(int $organizerPid): void
    {
        $this->organizerPid = $organizerPid;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getLocationPid(): int
    {
        return $this->locationPid;
    }

    /**
     * @param int $locationPid
     */
    public function setLocationPid(int $locationPid): void
    {
        $this->locationPid = $locationPid;
    }

    /**
     * @return string
     */
    public function getLocationLink(): string
    {
        return $this->locationLink;
    }

    /**
     * @param string $locationLink
     */
    public function setLocationLink(string $locationLink): void
    {
        $this->locationLink = $locationLink;
    }

    /**
     * @return int
     */
    public function getMonitorCnt(): int
    {
        return $this->monitorCnt;
    }

    /**
     * @param int $monitorCnt
     */
    public function setMonitorCnt(int $monitorCnt): void
    {
        $this->monitorCnt = $monitorCnt;
    }

    /**
     * @return int
     */
    public function getExceptionCnt(): int
    {
        return $this->exceptionCnt;
    }

    /**
     * @param int $exceptionCnt
     */
    public function setExceptionCnt(int $exceptionCnt): void
    {
        $this->exceptionCnt = $exceptionCnt;
    }

    /**
     * @return int
     */
    public function getFeCruserId(): int
    {
        return $this->feCruserId;
    }

    /**
     * @param int $feCruserId
     */
    public function setFeCruserId(int $feCruserId): void
    {
        $this->feCruserId = $feCruserId;
    }

    /**
     * @return int
     */
    public function getFeCrgroupId(): int
    {
        return $this->feCrgroupId;
    }

    /**
     * @param int $feCrgroupId
     */
    public function setFeCrgroupId(int $feCrgroupId): void
    {
        $this->feCrgroupId = $feCrgroupId;
    }

    /**
     * @return int
     */
    public function getSharedUserCnt(): int
    {
        return $this->sharedUserCnt;
    }

    /**
     * @param int $sharedUserCnt
     */
    public function setSharedUserCnt(int $sharedUserCnt): void
    {
        $this->sharedUserCnt = $sharedUserCnt;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getExtUrl(): string
    {
        return $this->extUrl;
    }

    /**
     * @param string $extUrl
     */
    public function setExtUrl(string $extUrl): void
    {
        $this->extUrl = $extUrl;
    }

    /**
     * @return int
     */
    public function getisTemp(): int
    {
        return $this->isTemp;
    }

    /**
     * @param int $isTemp
     */
    public function setIsTemp(int $isTemp): void
    {
        $this->isTemp = $isTemp;
    }

    /**
     * @return string
     */
    public function getIcsUid(): string
    {
        return $this->icsUid;
    }

    /**
     * @param string $icsUid
     */
    public function setIcsUid(string $icsUid): void
    {
        $this->icsUid = $icsUid;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImagecaption(): string
    {
        return $this->imagecaption;
    }

    /**
     * @param string $imagecaption
     */
    public function setImagecaption(string $imagecaption): void
    {
        $this->imagecaption = $imagecaption;
    }

    /**
     * @return string
     */
    public function getImagealttext(): string
    {
        return $this->imagealttext;
    }

    /**
     * @param string $imagealttext
     */
    public function setImagealttext(string $imagealttext): void
    {
        $this->imagealttext = $imagealttext;
    }

    /**
     * @return string
     */
    public function getImagetitletext(): string
    {
        return $this->imagetitletext;
    }

    /**
     * @param string $imagetitletext
     */
    public function setImagetitletext(string $imagetitletext): void
    {
        $this->imagetitletext = $imagetitletext;
    }

    /**
     * @return string
     */
    public function getAttachment(): string
    {
        return $this->attachment;
    }

    /**
     * @param string $attachment
     */
    public function setAttachment(string $attachment): void
    {
        $this->attachment = $attachment;
    }

    /**
     * @return string
     */
    public function getAttachmentcaption(): string
    {
        return $this->attachmentcaption;
    }

    /**
     * @param string $attachmentcaption
     */
    public function setAttachmentcaption(string $attachmentcaption): void
    {
        $this->attachmentcaption = $attachmentcaption;
    }

    /**
     * @return int
     */
    public function getRefEventId(): int
    {
        return $this->refEventId;
    }

    /**
     * @param int $refEventId
     */
    public function setRefEventId(int $refEventId): void
    {
        $this->refEventId = $refEventId;
    }

    /**
     * @return int
     */
    public function getSendInvitation(): int
    {
        return $this->sendInvitation;
    }

    /**
     * @param int $sendInvitation
     */
    public function setSendInvitation(int $sendInvitation): void
    {
        $this->sendInvitation = $sendInvitation;
    }

    /**
     * @return string
     */
    public function getAttendee(): string
    {
        return $this->attendee;
    }

    /**
     * @param string $attendee
     */
    public function setAttendee(string $attendee): void
    {
        $this->attendee = $attendee;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getCompleted(): int
    {
        return $this->completed;
    }

    /**
     * @param int $completed
     */
    public function setCompleted(int $completed): void
    {
        $this->completed = $completed;
    }

    /**
     * @return int
     */
    public function getT3verOid(): int
    {
        return $this->t3verOid;
    }

    /**
     * @param int $t3verOid
     */
    public function setT3verOid(int $t3verOid): void
    {
        $this->t3verOid = $t3verOid;
    }

    /**
     * @return int
     */
    public function getNoAutoPb(): int
    {
        return $this->noAutoPb;
    }

    /**
     * @param int $noAutoPb
     */
    public function setNoAutoPb(int $noAutoPb): void
    {
        $this->noAutoPb = $noAutoPb;
    }

    /**
     * @return string
     */
    public function getTxZ3calfieldsFees(): string
    {
        return $this->txZ3calfieldsFees;
    }

    /**
     * @param string $txZ3calfieldsFees
     */
    public function setTxZ3calfieldsFees(string $txZ3calfieldsFees): void
    {
        $this->txZ3calfieldsFees = $txZ3calfieldsFees;
    }

    /**
     * @return string
     */
    public function getTxZ3calfieldsContact(): string
    {
        return $this->txZ3calfieldsContact;
    }

    /**
     * @param string $txZ3calfieldsContact
     */
    public function setTxZ3calfieldsContact(string $txZ3calfieldsContact): void
    {
        $this->txZ3calfieldsContact = $txZ3calfieldsContact;
    }

    /**
     * @return int
     */
    public function getDeviation(): int
    {
        return $this->deviation;
    }

    /**
     * @param int $deviation
     */
    public function setDeviation(int $deviation): void
    {
        $this->deviation = $deviation;
    }

    /**
     * @return int
     */
    public function getCategories(): int
    {
        return $this->categories;
    }

    /**
     * @param int $categories
     */
    public function setCategories(int $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return int
     */
    public function getSorting(): int
    {
        return $this->sorting;
    }

    /**
     * @param int $sorting
     */
    public function setSorting(int $sorting): void
    {
        $this->sorting = $sorting;
    }

    /**
     * @return string
     */
    public function getTeaser(): string
    {
        return $this->teaser;
    }

    /**
     * @param string $teaser
     */
    public function setTeaser(string $teaser): void
    {
        $this->teaser = $teaser;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return Calendar
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * @param Calendar $calendar
     */
    public function setCalendar($calendar)
    {
        $this->calendar = $calendar;
    }

}
