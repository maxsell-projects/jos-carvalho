<?php
$xml = simplexml_load_file(__DIR__ . '/storage/app/test.xml');
if ($xml) {
    if(isset($xml->imovel)) {
        $first = $xml->imovel[0];
    } else {
        $children = $xml->children();
        $first = $children[0];
    }
    
    echo "Property reference: " . (string)$first->referencia . "\n";
    echo "Property title: " . (string)$first->tituloweb_pt . "\n";
    echo "Property type: " . (string)$first->tipo->nome . "\n";
    echo "Property status: " . (string)$first->natureza . "\n";
    echo "Property price: " . (string)$first->preco . "\n";
    echo "Property desc length: " . strlen((string)$first->txtpublicitario1_pt) . "\n";
    echo "City: " . (string)$first->concelho . "\n";
    echo "Loc: " . (string)$first->localidade . "\n";
    
    echo "Images count: " . count($first->multimedia->imagem) . "\n";
    if (count($first->multimedia->imagem) > 0) {
        echo "First image URL: " . (string)$first->multimedia->imagem[0]->url . "\n";
    }
}
