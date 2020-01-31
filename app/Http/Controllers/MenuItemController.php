<?php

namespace App\Http\Controllers;

use App\Item;
use App\Menu;
use Illuminate\Http\Request;
use App\Traits\ItemChildren;


class MenuItemController extends ApiController
{
    use ItemChildren;

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
