
plugin.tx_programmevents {
	settings {
		serachResultPage = 60
		fields = title
	}
  view {
    templateRootPaths.0 = EXT:programmevents/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_programmevents_programmevents.view.templateRootPath}
    partialRootPaths.0 = EXT:programmevents/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_programmevents_programmevents.view.partialRootPath}
    layoutRootPaths.0 = EXT:programmevents/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_programmevents_programmevents.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_programmevents.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_programmevents._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-programmevents table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-programmevents table th {
        font-weight:bold;
    }

    .tx-programmevents table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

page.includeCSS {
  css_01_tx_programmevents = EXT:programmevents/Resources/Public/Css/jquery-ui.css
  css_10_tx_programmevents = EXT:programmevents/Resources/Public/Css/style.css

}

page.includeJSFooter {
	js_10_tx_programmevents = EXT:programmevents/Resources/Public/Javascript/script.js
}

