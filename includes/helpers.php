<?php

function escape($str) {
    return mysql_real_escape_string($str);
}