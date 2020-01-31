<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Traits\ItemChildren;
use Illuminate\Support\Facades\DB;

class ItemChildrenController extends ApiController
{
    use ItemChildren;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Item $item)
    {
        $data = json_decode($request->getContent());
        
        $items = $this->recursive_store($data, $item->menu_id, $item->id);
        
        return $this->showAll(collect($items));
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $items = $this->recursive_index($item->menu, $item->id);
        return $this->showAll(collect($items));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $items_children = DB::table('items')->where('parent_id', $item->id)->get();
        foreach ($items_children as $children) {
            $this->recursive_destroy($children);
        }
    }
}
