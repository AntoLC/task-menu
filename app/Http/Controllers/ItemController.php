<?php

namespace App\Http\Controllers;

use App\Item;
use App\Menu;
use Illuminate\Http\Request;

class ItemController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'field' => 'required',
            'menu_id' => 'required',
        ];

        $this->validate($request, $rules);

        $menu = Menu::where('id', '=', $request->menu_id)->first();
        if (! $menu) {
            return $this->errorResponse("This is menu doesn't exist.", 404);
        }

        $item = Item::create([
            'field'  => $request->field,
            'menu_id'   => $request->menu_id,
        ]);
        return $this->showOne($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $this->showOne($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->fill($request->only([
            'field',
        ]));

        if ($item->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $item->save();

        return $this->showOne($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        // if($item['has_children'])
        // $this->recursive_destroy($item, $parent_id = 0)

        $item->delete();
    }

    /**
     * I will have implemented recursive destroy
     */
    // private function recursive_destroy($item, $parent_id = 0){
    //     $items_return = [];
    //     $items = $item->where('parent_id', '=', $item);
    //     foreach ($items as $item) {
    //         $items_return[] = $item;
    //         if($item['has_children'])
    //             $items_return[sizeof($items_return)-1]["children"] = $this->recursive_index($menu, $item["id"]);
    //     }

    //     return $items_return;
    // }
}
