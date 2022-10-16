<?php

namespace MenthaWeb\CommonFields;

use ProcessWire\Page;
use ProcessWire\WireData;

class NavigationApi extends WireData
{
    public function hasSubNav(Page $page, Page $navItem)
    {
        return (count($page->navItem->children) > 0 && $page->navItem->id !== 1);
    }

    public function getNavTitle(Page $navItem)
    {
        return (!empty($navItem->navigationTitle) ? $navItem->navigationTitle : $navItem->title);
    }

    public function getCssClasses(Page $page, Page $navItem)
    {
        $classes = [];
        if ($navItem->id === $page->id) {
            $classes[] = 'active';
        }

        if ($navItem->id === 1) {
            return $this->createString($classes);
        }

        if ($navItem->children->get('id='.$page->id)) {
            $classes[] = 'active-parent';
        }

        if (count($page->navItem->children) > 0) {
            $classes[] = 'has-subnav';
        }

        return $this->createString($classes);
    }

    private function createString($classes)
    {
        $classesString = ' ';
        $classesString .= implode(' ', $classes);
        return $classesString;
    }
    
}
