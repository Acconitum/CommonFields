<?php

namespace MenthaWeb\CommonFields;

class CompanyFieldsFactory extends AbstractFactory
{
    protected $fieldConfigs;

    public function __construct()
    {
        $this->fieldConfigs = [
            [
                'name' => 'companyTab',
                'type' => '\\ProcessWire\\FieldtypeFieldsetOpen',
                'label' => 'Company'
            ],
            [
                'name' => 'companyName',
                'type' => '\\ProcessWire\\FieldtypeText',
                'label' => 'Company Name'
            ],
            [
                'name' => 'companyStreet',
                'type' => '\\ProcessWire\\FieldtypeText',
                'label' => 'Company Street'
            ],
            [
                'name' => 'companyZip',
                'type' => '\\ProcessWire\\FieldtypeText',
                'label' => 'Company Zip'
            ],
            [
                'name' => 'companyCity',
                'type' => '\\ProcessWire\\FieldtypeText',
                'label' => 'Company City'
            ],
            [
                'name' => 'companyPhone',
                'type' => '\\ProcessWire\\FieldtypeText',
                'label' => 'Company Phone'
            ],
            [
                'name' => 'companyEmail',
                'type' => '\\ProcessWire\\FieldtypeEmail',
                'label' => 'Company Email'
            ],
            [
                'name' => 'companyLogo',
                'type' => '\\ProcessWire\\FieldtypeImage',
                'label' => 'Company Logo',
                'extensions' => 'gif jpg jpeg png svg'
            ],
            [
                'name' => 'companyTab_END',
                'type' => '\\ProcessWire\\FieldtypeFieldsetClose',
            ],
        ];
    }
}