## Neo4j TriadicSelection Performance Test

### Settings :

* OS X Yosemite
* Xmx4GB

### Dataset used : 

* Pokec Social Networks Relationships https://www.dropbox.com/s/qek7yu9u1buipi9/pokec225.zip?dl=0
* Loaded the first million rows of the tsv file
* Results in 310k users and 2 million relationships

Cypher Query used for loading the dataset :

```
USING PERIODIC COMMIT 500
LOAD CSV FROM "file:///Users/cw/dev/_data/pokec.txt" AS line
FIELDTERMINATOR "\t"
WITH line[0] as a, line[1] as b
LIMIT 1000000
MERGE (p:User {id: a})
MERGE (p2:User {id:b})
MERGE (p)-[:KNOWS]->(p2);
```

### Run the tests :

Download this repo and install the dependencies :

```bash
git clone git@github.com:ikwattro/neo4j-triadic-selection-test
composer install
```

Rename the `.env.dist` file to `.env` and adapt the settings of your neo4j db.

Run :

```bash
php run.php
```

Default limit of the test is 100 users, you can pass as argument another limit :

```bash
php run.php 1000
```

Result on 100 users :

```
305 FOFs found in 6ms
7733 FOFs found in 58ms
14 FOFs found in 5ms
14 FOFs found in 5ms
313 FOFs found in 7ms
14 FOFs found in 5ms
2051 FOFs found in 17ms
14 FOFs found in 4ms
680 FOFs found in 7ms
2443 FOFs found in 18ms
1827 FOFs found in 40ms
1346 FOFs found in 37ms
663 FOFs found in 23ms
405 FOFs found in 17ms
47 FOFs found in 9ms
345 FOFs found in 14ms
359 FOFs found in 16ms
1846 FOFs found in 32ms
9235 FOFs found in 194ms
786 FOFs found in 24ms
1799 FOFs found in 77ms
2257 FOFs found in 25ms
1356 FOFs found in 50ms
3834 FOFs found in 59ms
6020 FOFs found in 85ms
1772 FOFs found in 56ms
4480 FOFs found in 109ms
1450 FOFs found in 32ms
1359 FOFs found in 14ms
1606 FOFs found in 17ms
2262 FOFs found in 27ms
3379 FOFs found in 37ms
1291 FOFs found in 28ms
3904 FOFs found in 41ms
1572 FOFs found in 20ms
739 FOFs found in 13ms
574 FOFs found in 14ms
108 FOFs found in 10ms
1066 FOFs found in 50ms
1854 FOFs found in 15ms
1222 FOFs found in 12ms
2093 FOFs found in 28ms
4045 FOFs found in 49ms
2484 FOFs found in 33ms
628 FOFs found in 17ms
2249 FOFs found in 22ms
3670 FOFs found in 41ms
1311 FOFs found in 16ms
1051 FOFs found in 10ms
889 FOFs found in 38ms
1145 FOFs found in 16ms
821 FOFs found in 13ms
470 FOFs found in 7ms
2012 FOFs found in 30ms
1707 FOFs found in 18ms
4691 FOFs found in 33ms
3616 FOFs found in 35ms
14936 FOFs found in 131ms
3948 FOFs found in 52ms
8924 FOFs found in 93ms
651 FOFs found in 9ms
6578 FOFs found in 53ms
2956 FOFs found in 31ms
4164 FOFs found in 49ms
503 FOFs found in 12ms
3449 FOFs found in 40ms
3056 FOFs found in 44ms
4218 FOFs found in 33ms
564 FOFs found in 11ms
416 FOFs found in 8ms
772 FOFs found in 12ms
1277 FOFs found in 14ms
7129 FOFs found in 56ms
945 FOFs found in 17ms
2537 FOFs found in 17ms
56279 FOFs found in 438ms
606 FOFs found in 14ms
3472 FOFs found in 30ms
8035 FOFs found in 54ms
1976 FOFs found in 20ms
765 FOFs found in 9ms
494 FOFs found in 12ms
3132 FOFs found in 31ms
0 FOFs found in 8ms
872 FOFs found in 8ms
4587 FOFs found in 37ms
2119 FOFs found in 20ms
709 FOFs found in 15ms
3304 FOFs found in 26ms
18169 FOFs found in 130ms
4523 FOFs found in 35ms
3940 FOFs found in 32ms
5201 FOFs found in 37ms
3056 FOFs found in 21ms
3590 FOFs found in 31ms
444 FOFs found in 7ms
218 FOFs found in 10ms
1286 FOFs found in 11ms
2062 FOFs found in 17ms
3836 FOFs found in 30ms
```
