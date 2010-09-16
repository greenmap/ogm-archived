<?php

function richmobile_preprocess_page(&$variables) {
  unset($variables['css']['all']['modules']);
}