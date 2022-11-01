<?php

namespace MenthaWeb\CommonFields;

use ProcessWire\Page;
use ProcessWire\WireData;

class NavigationApi extends WireData
{
    public function hasSubNav(Page $navItem)
    {
        if (!$navItem->hasChildren || $navItem->id === 1) {
            return false;
        }
        foreach($navItem->children as $child) {
            if ($this->isItemDisplayable($child)) {
                return true;
            }
        }
        return false;
    }

    public function isItemDisplayable(Page $navItem)
    {
        return ($navItem->showInNavigation || $navItem->showInNavigation === "");
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

        if ($this->hasSubNav($navItem)) {
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
