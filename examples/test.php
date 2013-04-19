<?php

require_once('../lib/MarkovChain.php');

$markov = new MarkovChain();
$markov->build(new SimpleDataSource(array(
    'my blue car',
    'red and blue flowers',
    'his blue car'
)));

var_dump($markov->chain);

?>