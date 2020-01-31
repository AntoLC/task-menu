<?php

namespace App\Traits;

use App\Item;
use Illuminate\Support\Facades\DB;

trait ItemChildren
{
    private function recursive_index($menu, $parent_id = 0){
        $items_return = [];
        $items = $menu->items->where('parent_id', '=', $parent_id);
        foreach ($items as $item) {
            $items_return[] = $item;
            if($item['has_children'])
                $items_return[sizeof($items_return)-1]["children"] = $this->recursive_index($menu, $item["id"]);
        }

        return $items_return;
    }

    private function recursive_store($items_store, $menu_id, $parent = null){
        $items = [];
        foreach ($items_store as $item_store) {
            $item = [];
            $item['field']   = $item_store->field;
            $item['menu_id'] = $menu_id;

            if($parent)
                $item['parent_id'] = $parent;

            if(isset($item_store->children) && sizeof($item_store->children))
                $item['has_children'] = 1;

            $item = Item::create($item);
            $items[] = $item;

            if(isset($item_store->children) && sizeof($item_store->children))
                $items[sizeof($items)-1]["children"] = $this->recursive_store($item_store->children, $menu_id, $item->id);
        }

        return $items;
    }

    private function recursive_destroy($item){
        $items_children = DB::table('items')->where('parent_id', $item->id)->get();
        foreach ($items_children as $children) {
            if($children->has_children)
                $this->recursive_destroy($children);

            $item_child = Item::find($children->id);
            if($item_child)
                $item_child->delete();
        }

        $item_parent = Item::find($item->id);
        if($item_parent)
            $item_parent->delete();
    }
}
