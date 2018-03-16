
plugin.tx_programmevents {
  view {
    # cat=plugin.tx_programmevents_programmevents/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:programmevents/Resources/Private/Templates/
    # cat=plugin.tx_programmevents_programmevents/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:programmevents/Resources/Private/Partials/
    # cat=plugin.tx_programmevents_programmevents/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:programmevents/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_programmevents_programmevents//a; type=string; label=Default storage PID
    storagePid = 58
  }
}
