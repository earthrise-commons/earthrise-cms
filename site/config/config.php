<?php

return [

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
