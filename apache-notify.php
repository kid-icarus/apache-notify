#!/usr/bin/php
<?php

$old_count = 0;
while ($error_count = count_errors($argv[1])) {
  print $argv[1];
  if ($error_count > $old_count) {
    system('notify-send "New apache error detected"');
    $old_count = $error_count;
  }
  sleep(1);
}

function count_errors($filename) {
  $lines_command = "cat $filename | wc -l";
  $lines = system($lines_command);
  return $lines;
}
