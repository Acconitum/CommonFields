<?php

namespace ProcessWire;

class CommonFields extends WireData implements Module
{
    public static function getModuleInfo()
    {
        return [
            'title' => 'Common Fields',
            'summary' => 'Manages often used fields for templates',
            'version' => '1.0',
            'autoload' => true
        ];
    }

    public function ready()
    {
        if (!wire('user')->isSuperuser()) {
            return;
        }

        wire('templates')->getAll()->each(function($template) {
            if ($template->name !== 'admin' && $template->name !== 'role' && $template->name !== 'user' && $template->name !== 'permission') {
                $this->addFieldsToTemplate($template);
            }
        });
    }

    private function addFieldsToTemplate($template)
    {
        $this->installSeoFields($template);
        $this->installPageOptionFields($template);
    }

    private function installPageOptionFields($template)
    {
        if (!$template->fields->get('pageOptions')) {
            if (wire('fields')->get('pageOptions')) {
                $field = wire('fields')->get('pageOptions');
            } else {
                $field = new Field();
                $field->setName('pageOptions');
                $field->setLabel('Page Options');
                $field->setFieldtype('\\ProcessWire\\FieldtypeFieldsetTabOpen');
                $field->save();
            }
            $template->fields->add($field);
            $template->fields->save();
        }

        if (!$template->fields->get('showInMenu')) {
            if (wire('fields')->get('showInMenu')) {
                $field = wire('fields')->get('showInMenu');
            } else {
                $field = new Field();
                $field->setName('showInMenu');
                $field->setLabel('Show in main navigaiton');
                $field->setFieldtype('\\ProcessWire\\FieldtypeToggle');
                $field->save();
            }
            $existing = $template->fields->get('pageOptions');
            $template->fields->insertAfter($field, $existing);
            $template->fields->save();
        }

        if (!$template->fields->get('navigationTitle')) {
            if (wire('fields')->get('navigationTitle')) {
                $field = wire('fields')->get('navigationTitle');
            } else {
                $field = new Field();
                $field->setName('navigationTitle');
                $field->setLabel('Navigation Title');
                $field->setDescription('If set, this value will be shown in the navigation instead of the pagetitle');
                $field->setFieldtype('\\ProcessWire\\FieldtypeText');
                $field->set('textformatters', 'TextformatterEntities');
                $field->save();
            }
            $existing = $template->fields->get('showInMenu');
            $template->fields->insertAfter($field, $existing);
            $template->fields->save();
        }

        if (!$template->fields->get('pageOptions_END')) {
            if (wire('fields')->get('pageOptions_END')) {
                $field = wire('fields')->get('pageOptions_END');
            } else {
                $field = new Field();
                $field->setName('pageOptions_END');
                $field->setFieldtype('\\ProcessWire\\FieldtypeFieldsetClose');
                $field->save();
            }
            $existing = $template->fields->get('navigationTitle');
            $template->fields->insertAfter($field, $existing);
            $template->fields->save();
        }
    }

    private function installSeoFields($template)
    {
        if (!$template->fields->get('seoTab')) {
            if (wire('fields')->get('seoTab')) {
                $field = wire('fields')->get('seoTab');
            } else {
                $field = new Field();
                $field->setName('seoTab');
                $field->setLabel('SEO');
                $field->setFieldtype('\\ProcessWire\\FieldtypeFieldsetTabOpen');
                $field->save();
            }
            $template->fields->add($field);
            $template->fields->save();
        }

        if (!$template->fields->get('seoTitle')) {
            if (wire('fields')->get('seoTitle')) {
                $field = wire('fields')->get('seoTitle');
            } else {
                $field = new Field();
                $field->setName('seoTitle');
                $field->setLabel('SEO Title');
                $field->setDescription('If set, the content of this field will be used for the title meta tag');
                $field->setFieldtype('\\ProcessWire\\FieldtypeText');
                $field->set('textformatters', 'TextformatterEntities');
                $field->save();
            }
            $template->fields->add($field);
            $template->fields->save();
        }

        if (!$template->fields->get('seoDescription')) {
            if (wire('fields')->get('seoDescription')) {
                $field = wire('fields')->get('seoDescription');
            } else {
                $field = new Field();
                $field->setName('seoDescription');
                $field->setLabel('SEO Description');
                $field->setDescription('If set, the content of this field will be used for the description meta tag');
                $field->setFieldtype('\\ProcessWire\\FieldtypeTextarea');
                $field->set('inputfieldClass', 'InputfieldTextarea');
                $field->set('contentType', 0);
                $field->set('collapsed', 0);
                $field->set('minlength', 0);
                $field->set('maxlength', 0);
                $field->set('showCount', 0);
                $field->set('rows', 5);
                $field->set('textformatters', 'TextformatterEntities');
                $field->save();
            }
            $template->fields->add($field);
            $template->fields->save();
        }

        if (!$template->fields->get('seoTab_END')) {
            if (wire('fields')->get('seoTab_END')) {
                $field = wire('fields')->get('seoTab_END');
            } else {
                $field = new Field();
                $field->setName('seoTab_END');
                $field->setFieldtype('\\ProcessWire\\FieldtypeFieldsetClose');
                $field->save();
            }
            $template->fields->add($field);
            $template->fields->save();
        }
    }
}
