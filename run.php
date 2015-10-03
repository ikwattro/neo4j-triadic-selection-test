<?php

require_once(__DIR__.'/vendor/autoload.php');

use Neoxygen\NeoClient\ClientBuilder;
use Dotenv\Dotenv;
use Symfony\Component\Stopwatch\Stopwatch;

$limit = (isset($argv[1]) && is_numeric($argv[1])) ? (int) $argv[1] : 100;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();
$client = ClientBuilder::create()
    ->addConnection('default', getenv('NEO4J_SCHEME'), getenv('NEO4J_HOST'), (int) getenv('NEO4J_PORT'), true, 'neo4j', getenv('NEO4J_PASSWORD'))
    ->setAutoFormatResponse(true)
    ->enableNewFormattingService()
    ->build();
$stopwatch = new Stopwatch();

$q = 'MATCH (n:User) RETURN n.id as id LIMIT {limit}';
$results = $client->sendCypherQuery($q, ['limit' => $limit])->getResult()->getTableFormat();
foreach ($results->getRows() as $k => $row) {
    $query = 'MATCH (a:User {id: {id}})-[:KNOWS]->(b:User)-[:KNOWS]->(c:User)
    WHERE NOT (a)-[:KNOWS]->(c)
    RETURN count(c) AS fof';
    $stopwatch->start($k);
    $result = $client->sendCypherQuery($query, ['id' => $row['id']])->getResult();
    $e = $stopwatch->stop($k);
    echo $result->get('fof', true) . ' FOFs found in ' . $e->getDuration() . 'ms' . PHP_EOL;
}