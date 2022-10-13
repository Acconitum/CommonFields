<?php

namespace ProcessWire;

use MenthaWeb\CommonFields\SiteOptions;

class CommonFields extends WireData implements Module
{

    const MODULE_NAMESPACE = 'MenthaWeb\\CommonFields';


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
        $this->loadModuleNamespace();

        if (!$this->user->isSuperuser()) {
            return;
        }

        $siteOptions = new SiteOptions();
        $siteOptions->init();

        $this->templates->getAll()->each(function($template) {
            if ($template->name !== 'admin' && $template->name !== 'role' && $template->name !== 'user' && $template->name !== 'permission') {
                $this->addFieldsToTemplate($template);
            }
        });
    }

    private function loadModuleNamespace()
    {
        if (!$this->wire('classLoader')->hasNamespace(self::MODULE_NAMESPACE)) {
            $srcPath = $this->wire('config')->paths->get($this) . 'src/';
            $this->wire('classLoader')->addNamespace(self::MODULE_NAMESPACE, $srcPath);
        }
    }

    private function addFieldsToTemplate($template)
    {
        $this->installContentFields($template);
        $this->installPageOptionFields($template);
        $this->installSeoFields($template);
    }

    private function installContentFields($template)
    {
        if (!$template->fields->get('lead')) {
            if ($this->fields->get('lead')) {
                $field = $this->fields->get('lead');
            } else {
                $field = new Field();
                $field->setName('lead');
                $field->setLabel('Lead');$field->setFieldtype('\\ProcessWire\\FieldtypeTextarea');
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
            $existing = $template->fields->get('title');
            $template->fields->insertAfter($field, $existing);
            $template->fields->save();
        }
    }

    private function installPageOptionFields($template)
    {
        if (!$template->fields->get('pageOptions')) {
            if ($this->fields->get('pageOptions')) {
                $field = $this->fields->get('pageOptions');
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
            if ($this->fields->get('showInMenu')) {
                $field = $this->fields->get('showInMenu');
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
            if ($this->fields->get('navigationTitle')) {
                $field = $this->fields->get('navigationTitle');
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
            if ($this->fields->get('pageOptions_END')) {
                $field = $this->fields->get('pageOptions_END');
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
            if ($this->fields->get('seoTab')) {
                $field = $this->fields->get('seoTab');
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
            if ($this->fields->get('seoTitle')) {
                $field = $this->fields->get('seoTitle');
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
            if ($this->fields->get('seoDescription')) {
                $field = $this->fields->get('seoDescription');
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
            if ($this->fields->get('seoTab_END')) {
                $field = $this->fields->get('seoTab_END');
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
