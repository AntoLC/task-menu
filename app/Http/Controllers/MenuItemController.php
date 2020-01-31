<?php

namespace App\Http\Controllers;

use App\Item;
use App\Menu;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MenuItemController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Menu $menu)
    {
        $items = $this->recursive_index($menu);
        return $this->showAll(collect($items));
    }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Menu $menu)
    {
        $data = json_decode($request->getContent());
        
        $items = $this->recursive_store($data, $menu->id);
        
        return $this->showAll(collect($items));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, Item $item)
    {
        $menu->items()->delete();
    }
}
