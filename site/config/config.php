<?php

return [
// TODO: customize left panel nav options to add individual collections
// https://getkirby.com/docs/reference/system/options/panel/panel-menu

// custom panel favicon:
// TODO: ask Olivia to create a new favicon
  'panel' => [
    'favicon' => 'assets/ec-favicon.svg',
  ],

  'hooks' => [
    'page.create:after' => function ($page) {
    
      // set initial displayName for person pages to match title
      if (in_array($page->intendedTemplate()->name(), ['person'])) {
        if ($page->content()->get('displayName')->isEmpty()) {
          $page->update([
            'displayName' => $page->title()->value()
          ]);
        }
      }
    

    
    },

  ],
];
