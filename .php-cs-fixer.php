<?php
/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:3.11.0|configurator
 * you can change this configuration by importing this file.
 */
$config = new PhpCsFixer\Config();
return $config
    ->setRiskyAllowed(getenv('PHP_CS_FIXER_RISKY') === '1')
    ->setRules([
        '@PSR12' => true,
        '@PhpCsFixer' => true,
        '@PHP81Migration' => true,
        '@PHP54Migration' => true,
        '@PHP56Migration:risky' => getenv('PHP_CS_FIXER_RISKY') === '1',
        '@PHP70Migration' => true,
        '@PHP70Migration:risky' => getenv('PHP_CS_FIXER_RISKY') === '1',
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => getenv('PHP_CS_FIXER_RISKY') === '1',
        '@PHP73Migration' => true,
        '@PHP74Migration' => true,
        '@PHP74Migration:risky' => getenv('PHP_CS_FIXER_RISKY') === '1',
        '@PHP80Migration' => true,
        '@PHP80Migration:risky' => getenv('PHP_CS_FIXER_RISKY') === '1',
        '@PhpCsFixer:risky' => getenv('PHP_CS_FIXER_RISKY') === '1',
        // PHP arrays should be declared using the configured syntax.
        'array_syntax' => true,
        // The body of each control structure MUST be enclosed within braces.
        'control_structure_braces' => true,
        // Control structure continuation keyword must be on the configured line.
        'control_structure_continuation_position' => true,
        // Curly braces must be placed as configured.
        'curly_braces_position' => true,
        // Class `DateTimeImmutable` should be used instead of `DateTime`.
        'date_time_immutable' => getenv('PHP_CS_FIXER_RISKY') === '1',
        // There must not be spaces around `declare` statement parentheses.
        'declare_parentheses' => true,
        // All `public` methods of `abstract` classes should be `final`.
        'final_public_method_for_abstract_class' => getenv('PHP_CS_FIXER_RISKY') === '1',
        // Replace non multibyte-safe functions with corresponding mb function.
        'mb_str_functions' => getenv('PHP_CS_FIXER_RISKY') === '1',
        // There must not be more than one statement per line.
        'no_multiple_statements_per_line' => true,
        // Adds or removes `?` before type declarations for parameters with a default `null` value.
        'nullable_type_declaration_for_default_null_value' => true,
        // Fixes casing of PHPDoc tags.
        'phpdoc_tag_casing' => true,
        // Inside a `final` class or anonymous class `self` should be preferred to `static`.
        'self_static_accessor' => true,
        // Simplify `if` control structures that return the boolean result of their condition.
        'simplified_if_return' => true,
        // A return statement wishing to return `void` should not return `null`.
        'simplified_null_return' => true,
        // Each statement must be indented.
        'statement_indentation' => true,
        // Forbid multi-line whitespace before the closing semicolon or move the semicolon to the new line for chained calls.
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        // Enforce camel (or snake) case for PHPUnit test methods, following configuration.
        'php_unit_method_casing' => ['case' => 'snake_case'],
        // Imports or fully qualifies global classes/functions/constants.
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => false,
            'import_functions' => true,
        ],
        // Ordering use statements.
        'ordered_imports' => [
            'imports_order' => [
                'const',
                'class',
                'function',
            ],
            'sort_algorithm' => 'alpha'
        ]
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude('vendor')
        ->exclude('var')
        ->in(__DIR__)
    );
