# Menu manager


## Getting Started

You can configure the environnement by editing .env, as it is now it is working: 
```
./.env
```

Just Run:
```
docker-compose up --build
```

Laravel Endpoints: http://localhost:2500

PHPMyAdmin: http://localhost:2502

## Endpoints Done

```
+--------+-----------+---------------------------------+-------------------+-----------------------------------------------------+------------+
|        | POST      | api/items                       | items.store       | App\Http\Controllers\ItemController@store           | api        |
|        | DELETE    | api/items/{item}                | items.destroy     | App\Http\Controllers\ItemController@destroy         | api        |
|        | PUT|PATCH | api/items/{item}                | items.update      | App\Http\Controllers\ItemController@update          | api        |
|        | GET|HEAD  | api/items/{item}                | items.show        | App\Http\Controllers\ItemController@show            | api        |
|        | DELETE    | api/items/{item}/children       |                   | App\Http\Controllers\ItemChildrenController@destroy | api        |
|        | GET|HEAD  | api/items/{item}/children       |                   | App\Http\Controllers\ItemChildrenController@show    | api        |
|        | POST      | api/items/{item}/children       |                   | App\Http\Controllers\ItemChildrenController@store   | api        |
|        | GET|HEAD  | api/menus                       | menus.index       | App\Http\Controllers\MenuController@index           | api        |
|        | POST      | api/menus                       | menus.store       | App\Http\Controllers\MenuController@store           | api        |
|        | DELETE    | api/menus/{menu}                | menus.destroy     | App\Http\Controllers\MenuController@destroy         | api        |
|        | PUT|PATCH | api/menus/{menu}                | menus.update      | App\Http\Controllers\MenuController@update          | api        |
|        | GET|HEAD  | api/menus/{menu}                | menus.show        | App\Http\Controllers\MenuController@show            | api        |
|        | DELETE    | api/menus/{menu}/items          |                   | App\Http\Controllers\MenuItemController@destroy     | api        |
|        | POST      | api/menus/{menu}/items          | menus.items.store | App\Http\Controllers\MenuItemController@store       | api        |
|        | GET|HEAD  | api/menus/{menu}/items          | menus.items.index | App\Http\Controllers\MenuItemController@index       | api        |
+--------+-----------+---------------------------------+-------------------+-----------------------------------------------------+------------+
```

## Time up... With more time I would have made:

```
/menus/{menu}/layers/{layer} 
/menus/{menu}/depth
```

I didn't implement tests, but I know how to use it, I would have tested the endpoint in ```tests/Feature``` folder, and use ```.env.testing```.

PhpCS | PhpCsFixer | PhpStan are installed but I didn't have the times to use them.

I would have made a better documentation as well.

## 10 vs 1.000.000 menu items - what would you do differently?

Pagination

Search Query

Trie node to research data? (https://en.wikipedia.org/wiki/Trie)
