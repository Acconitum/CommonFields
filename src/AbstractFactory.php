<?php

namespace MenthaWeb\CommonFields;

use ProcessWire\Field;
use ProcessWire\Template;
use ProcessWire\WireData;

abstract class AbstractFactory extends WireData
{

    public function create(Template $template)
    {
        foreach($this->fieldConfigs as $fieldConfig) {
            $this->addOrUpdateFieldInTemplate($fieldConfig, $template);
        }
    }

    public function addOrUpdateFieldInTemplate(array $fieldConfig, Template $template)
    {
        $field = $this->getOrCreateField($fieldConfig);        
        $this->setCommonValues($field, $fieldConfig);

        switch($fieldConfig['type']) {
            case '\\ProcessWire\\FieldtypeText':
                $field->set('textformatters', 'TextformatterEntities');
                break;
            case '\\ProcessWire\\FieldtypeImage':
                $field->extensions = $fieldConfig['extensions'] ?? 'gif jpg jpeg png';
                break;
        }

        $field->save();

        if($template->fields->exists($fieldConfig['name'])) {
            return;
        }

        $this->addOrUpate($fieldConfig, $template, $field);
    }

    protected function getOrCreateField(array $fieldConfig)
    {
        if(in_array($fieldConfig['name'], $this->fields->getAllNames())) {
            return $this->fields->get($fieldConfig['name']);
        } else {
            $field = new Field();
            $field->setName($fieldConfig['name']);
            return $field;
        }
    }

    protected function addOrUpate(array $fieldConfig, Template $template, Field $field)
    {
        if (!empty($fieldConfig['insertAfter']) && $template->fields->exists($fieldConfig['insertAfter'])) {
            $previousField = $template->fields->get($fieldConfig['insertAfter']);
            $template->fields->insertAfter($field, $previousField);
        } else {
            $template->fields->add($field);
        }

        $template->save();
    }

    protected function setCommonValues(Field $field, array $fieldConfig)
    {
        $field->setLabel($fieldConfig['label'] ?? '');
        $field->setDescription($fieldConfig['description'] ?? '');
        $field->setFieldtype($fieldConfig['type']);
        return $field;
    }
}