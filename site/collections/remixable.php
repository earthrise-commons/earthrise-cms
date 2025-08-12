<?php

return function ($site) {
  $lessons = $site->find('lessons')->children();
  $chapters = $site->find('chapters')->children();
  return $lessons->merge($chapters);
};