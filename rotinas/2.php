<?php
require_once 'setup.php';
$index = Zend_Search_Lucene::create('/data/my-index');
$doc = new Zend_Search_Lucene_Document();

// Store document URL to identify it in the search results
$doc->addField(Zend_Search_Lucene_Field::Text('url', "id1"));

// Index document contents
$doc->addField(Zend_Search_Lucene_Field::UnStored('contents',"contente"));

// Add document to the index
$index->addDocument($doc);
$indexSize = $index->count();
$documents = $index->numDocs();
print_r($indexSize);
print_r($documents);

