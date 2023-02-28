<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('tests/Fixtures')
    ->in(__DIR__)
    ->append([
        __DIR__.'/dev-tools/doc.php',
        // __DIR__.'/php-cs-fixer', disabled, as we want to be able to run bootstrap file even on lower PHP version, to show nice message
    ])
;

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP71Migration:risky' => true,
        '@PHPUnit75Migration:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']],
        '@Symfony' => true,
        '@Symfony:risky' => false,
        '@PSR2' => true,
        '@PHP71Migration' => true,
        'blank_line_after_namespace' => true,
        'braces' => true,
        'class_definition' => true,
        'elseif' => true,
        'function_declaration' => true,
        'indentation_type' => true,
        'line_ending' => true,
        'lowercase_cast' => true,
        'lowercase_keywords' => true,
        'method_argument_space' => [
            'keep_multiple_spaces_after_comma' => true,
        ],
        'multiline_whitespace_before_semicolons' => false,
        'no_break_comment' => true,
        'no_closing_tag' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'single_blank_line_at_eof' => true,
        'single_class_element_per_statement' => [
            'elements' => ['property'],
        ],
        'declare_strict_types' => false,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'visibility_required' => true,
        'encoding' => true,
        'full_opening_tag' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'no_superfluous_phpdoc_tags' => false,
        'phpdoc_align' => false,
        'concat_space' => false,
        'phpdoc_separation' => false,
        'phpdoc_summary' => false,
        'phpdoc_no_alias_tag' => false,
    ])
    ->setFinder($finder)
;

//// special handling of fabbot.io service if it's using too old PHP CS Fixer version
//if (false !== getenv('FABBOT_IO')) {
//    try {
//        PhpCsFixer\FixerFactory::create()
//            ->registerBuiltInFixers()
//            ->registerCustomFixers($config->getCustomFixers())
//            ->useRuleSet(new PhpCsFixer\RuleSet($config->getRules()))
//        ;
//    } catch (PhpCsFixer\ConfigurationException\InvalidConfigurationException $e) {
//        $config->setRules([]);
//    } catch (UnexpectedValueException $e) {
//        $config->setRules([]);
//    } catch (InvalidArgumentException $e) {
//        $config->setRules([]);
//    }
//}

return $config;
