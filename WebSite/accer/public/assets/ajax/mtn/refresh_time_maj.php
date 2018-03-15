<?php
define("WEB_PATH", dirname(realpath('refresh_time_maj.php'),5));
require WEB_PATH.'/function/maintenance.php';
if (is_maintenance()) {
    echo getMaintenanceData()[0];
} else {
    echo '1';
}