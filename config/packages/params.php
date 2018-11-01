<?php
if (array_key_exists('HTTP_HOST', $_SERVER)) {
    $container->setParameter('host', $_SERVER['HTTP_HOST']);
} else {
    $container->setParameter('host', 'www.villadbay.com');
}
