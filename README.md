# Markov Chain for PHP #

A Markov chain is a mathematical system that undergoes transitions from one state to another, between a finite or countable number of possible states.

Markov chain can be used in:
- Automatic text generation
- Pattern recognition
- Analysing process flow (e.g. Google's PageRank)
- Data compression

Learn more about Markov Chain at http://en.wikipedia.org/wiki/Markov_chain

## Usage ##
```php
require_once('./lib/MarkovChain.php');

$markov = new MarkovChain();
$markov->build(new SimpleDataSource(array(
    'my blue car',
    'red and blue flowers',
    'his blue car'
)));

var_dump($markov->chain);
```

## Sample output ##
```php
array(
    'my' => array(
      'blue' => 1
    ),
    'blue' => array(
        'car' => 0.6
        'flowers' => 0.3
    ),
    'red' => array(
        'and' => 1
    ),
    'and' => array(
        'blue' => 1
    ),
    'his' => array(
      'blue' => 1
    )
);
```

## Further releases ##
- Hidden Markov Model
- MySQL data source
- MongoDB data source