<?php

require_once('../lib/DataSource.php');

/**
 * Markov Chain
 *
 * @author Lukasz Krawczyk <contact@lukaszkrawczyk.eu>
 * @copyright Copyright © 2013 Lukasz Krawczyk
 * @license MIT
 * @link http:/www.lukaszkrawczyk.eu
 */
class MarkovChain {
    /**
     * Markov chain
     * @var array
     */
    public $chain;

    /**
     * Token relations
     * @var array
     */
    public $relations;

    /**
     * Building Markov Chain
     *
     * @param IDataSource $dataSource
     */
    public function build($dataSource) {

        while ($document = $dataSource->getNextDocument()) {
            $tokens = $this->tokenise($document);
            // count relations between nodes
            for ($i = 1; $i < count($tokens); $i++) {
                $previous = $tokens[$i - 1];
                $current = $tokens[$i];
                $this->relations[$previous][$current] =
                    (isset($this->relations[$previous][$current]))
                    ? $this->relations[$previous][$current] + 1
                    : 1;
            }
        }

        // count probability within Markov Chain
        foreach ($this->relations as $source => $destinations) {
            $total = array_sum($destinations);
            if ($total > 0) {
                foreach ($destinations as $destination => $counter) {
                    $this->chain[$source][$destination] = $counter / $total;
                }
            }
        }
    }

    /**
     * Tokenize given text
     * Only for strings divided by space
     *
     * @param string $text
     * @return array
     */
    private function tokenise($text) {
        mb_internal_encoding("utf-8");
        mb_regex_encoding("utf-8");
        $text = mb_strtolower(mb_convert_kana($text, 'as'));
        return preg_split('/\s+/', $text);
    }
}

?>