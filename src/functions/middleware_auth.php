<?php
if ($_ENV['SERVICE_AUTH_TOKEN'] != $pass) {
    echo "No autorized";
    exit;
}
