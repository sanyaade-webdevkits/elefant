<?php

if ($controller->called['social/google/init'] > 1) {
	return;
}

$page->tail .= $tpl->render ('social/google/init');

?>