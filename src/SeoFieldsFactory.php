<?php

namespace MenthaWeb\CommonFields;

class SeoFieldsFactory extends AbstractFactory
{
    protected $fieldConfigs = [
        [
            'name' => 'SEOTab',
            'type' => '\\ProcessWire\\FieldtypeFieldsetOpen',
            'label' => 'SEO'
        ],
        [
            'name' => 'SEOTab_END',
            'type' => '\\ProcessWire\\FieldtypeFieldsetClose',
        ],
    ];
}