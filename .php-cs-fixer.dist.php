<?php

$finder = PhpCsFixer\Finder::create()
    ->in('src')
    ->in('tests')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_superfluous_phpdoc_tags' => true,
    ])
    ->setFinder($finder)
    ;
