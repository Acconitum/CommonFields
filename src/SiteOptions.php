<?php

namespace MenthaWeb\CommonFields;

use ProcessWire\WireData;

class SiteOptions extends WireData
{
    private $fieldSetOpen = [
        'name' => 'optionsTab',
        'type' => '\\ProcessWire\\FieldtypeFieldsetTabOpen',
        'label' => 'Site Options'
    ];

    private $fieldSetClose = [
        'name' => 'optionsTab_END',
        'type' => '\\ProcessWire\\FieldtypeFieldsetClose',
    ];
    public function init()
    {
        $companyFieldsFactory = new CompanyFieldsFactory();
        $companyFieldsFactory->addOrUpdateFieldInTemplate($this->fieldSetOpen, $this->templates->get('home'));

        $companyFieldsFactory->create($this->templates->get('home'));

        $companyFieldsFactory->addOrUpdateFieldInTemplate($this->fieldSetClose, $this->templates->get('home'));
    }
}