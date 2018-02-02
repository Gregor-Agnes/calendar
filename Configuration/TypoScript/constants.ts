
plugin.tx_calendar_events {
    view {
        # cat=plugin.tx_calendar_events/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:calendar/Resources/Private/Templates/
        # cat=plugin.tx_calendar_events/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:calendar/Resources/Private/Partials/
        # cat=plugin.tx_calendar_events/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:calendar/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_calendar_events//a; type=string; label=Default storage PID
        storagePid =
    }
}

plugin.tx_calendar_test {
    view {
        # cat=plugin.tx_calendar_test/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:calendar/Resources/Private/Templates/
        # cat=plugin.tx_calendar_test/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:calendar/Resources/Private/Partials/
        # cat=plugin.tx_calendar_test/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:calendar/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_calendar_test//a; type=string; label=Default storage PID
        storagePid =
    }
}
