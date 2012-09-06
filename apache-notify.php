#!/usr/bin/php
<?php

$old_count = 0;
while ($error_count = count_errors($argv[1])) {
  print $argv[1];
  if ($error_count > $old_count) {
    send_notification();
    $old_count = $error_count;
  }
  sleep(1);
}

function count_errors($filename) {
  $lines_command = "cat $filename | wc -l";
  $lines = system($lines_command);
  return $lines;
}

function send_notification() {
  switch (PHP_OS) {
    case 'Linux':
      system('notify-send "New apache error detected"');
      break;

    case 'Darwin':
      system('growlnotify -s -a terminal -t "Apache Error" -m "New apache error detected"');
      break;
  }
}
