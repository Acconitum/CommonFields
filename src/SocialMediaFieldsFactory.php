<?php

namespace MenthaWeb\CommonFields;

class SocialMediaFieldsFactory extends AbstractFactory
{
    protected $fieldConfigs = [
        [
            'name' => 'SocialMediaTab',
            'type' => '\\ProcessWire\\FieldtypeFieldsetOpen',
            'label' => 'Social Media'
        ],
        [
            'name' => 'facebook',
            'type' => '\\ProcessWire\\FieldtypeText',
            'label' => 'Facebook'
        ],
        [
            'name' => 'instagram',
            'type' => '\\ProcessWire\\FieldtypeText',
            'label' => 'Instagram'
        ],
        [
            'name' => 'twitter',
            'type' => '\\ProcessWire\\FieldtypeText',
            'label' => 'Twitter'
        ],
        [
            'name' => 'linkedin',
            'type' => '\\ProcessWire\\FieldtypeText',
            'label' => 'LinkedIn'
        ],
        [
            'name' => 'xing',
            'type' => '\\ProcessWire\\FieldtypeText',
            'label' => 'Xing'
        ],
        [
            'name' => 'tiktok',
            'type' => '\\ProcessWire\\FieldtypeText',
            'label' => 'Tiktok'
        ],
        [
            'name' => 'SocialMediaTab_END',
            'type' => '\\ProcessWire\\FieldtypeFieldsetClose',
        ],
    ];
}