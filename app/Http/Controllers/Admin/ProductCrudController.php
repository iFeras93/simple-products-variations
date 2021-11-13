<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/products');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */

        CRUD::column('title')
            ->type('text');
        CRUD::column('description')
            ->type('text');
        CRUD::addColumn(['name' => 'price', 'type' => 'number', 'prefix' => '$']);
        // remove a button
        $this->crud->removeButtons(['update', 'show']);

        if (backpack_auth()->user()->hasRole('Stores')) {
            $this->crud->addClause('where', 'user_id', backpack_auth()->user()->id);
        }
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
        CRUD::field('title')
            ->type('text');
        CRUD::field('description')
            ->type('textarea');

        CRUD::field('image')->type('browse');
        CRUD::addField([   // repeatable
            'name' => 'price', 'type' => 'number', 'prefix' => '$'
        ]);

        CRUD::addField([   // repeatable
            'name' => 'color',
            'label' => 'Color',
            'type' => 'repeatable',
            'fake' => true, // show the field, but don't store it in the database column above
            'store_in' => 'extra_data', // [optional] the database column name where you want the fake fields to ACTUALLY be stored as a JSON array
            'fields' => [
                [   // Text
                    'name' => 'title',
                    'label' => "Title",
                    'type' => 'text',
                ],
                [   // Browse
                    'name' => 'image',
                    'label' => 'Image',
                    'type' => 'browse'
                ],
            ],
            // optional
            'new_item_label' => 'Add New', // customize the text of the button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
            'min_rows' => 0, // minimum rows allowed, when reached the "delete" buttons will be hidden
            'max_rows' => 10, // maximum rows allowed, when reached the "new item" button will be hidden
        ]);
        CRUD::addField([   // repeatable
            'name' => 'sizes',
            'label' => 'Sizes',
            'type' => 'repeatable',
            'fake' => true, // show the field, but don't store it in the database column above
            'store_in' => 'extra_data', // [optional] the database column name where you want the fake fields to ACTUALLY be stored as a JSON array
            'fields' => [
                [   // Text
                    'name' => 'title',
                    'label' => "Title",
                    'type' => 'text',
                ],
            ],
            // optional
            'new_item_label' => 'Add New', // customize the text of the button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
            'min_rows' => 0, // minimum rows allowed, when reached the "delete" buttons will be hidden
            'max_rows' => 10, // maximum rows allowed, when reached the "new item" button will be hidden
        ]);
//        CRUD::addField([   // repeatable
//            'name' => 'capacities',
//            'label' => 'Capacities',
//            'type' => 'repeatable',
//            'fake' => true, // show the field, but don't store it in the database column above
//            'store_in' => 'extra_data', // [optional] the database column name where you want the fake fields to ACTUALLY be stored as a JSON array
//            'fields' => [
//                [   // Text
//                    'name' => 'title',
//                    'label' => "Title",
//                    'type' => 'text',
//                ],
//            ],
//            // optional
//            'new_item_label' => 'Add New', // customize the text of the button
//            'init_rows' => 0, // number of empty rows to be initialized, by default 1
//            'min_rows' => 0, // minimum rows allowed, when reached the "delete" buttons will be hidden
//            'max_rows' => 10, // maximum rows allowed, when reached the "new item" button will be hidden
//        ]);
        CRUD::addField([   // repeatable
            'name' => 'types',
            'label' => 'Types',
            'type' => 'repeatable',
            'fake' => true, // show the field, but don't store it in the database column above
            'store_in' => 'extra_data', // [optional] the database column name where you want the fake fields to ACTUALLY be stored as a JSON array
            'fields' => [
                [   // Text
                    'name' => 'title',
                    'label' => "Title",
                    'type' => 'text',
                ],
                [   // Browse
                    'name' => 'image',
                    'label' => 'Image',
                    'type' => 'browse'
                ],
            ],
            // optional
            'new_item_label' => 'Add New', // customize the text of the button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
            'min_rows' => 0, // minimum rows allowed, when reached the "delete" buttons will be hidden
            'max_rows' => 10, // maximum rows allowed, when reached the "new item" button will be hidden
        ]);
        CRUD::addField([   // repeatable
            'name' => 'texts',
            'label' => 'Texts',
            'type' => 'repeatable',
            'fake' => true, // show the field, but don't store it in the database column above
            'store_in' => 'extra_data', // [optional] the database column name where you want the fake fields to ACTUALLY be stored as a JSON array
            'fields' => [
                [   // Text
                    'name' => 'title',
                    'label' => "Title",
                    'type' => 'text',
                ], [   // Text
                    'name' => 'description',
                    'label' => "Description",
                    'type' => 'textarea',
                ],
            ],
            // optional
            'new_item_label' => 'Add New', // customize the text of the button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
            'min_rows' => 0, // minimum rows allowed, when reached the "delete" buttons will be hidden
            'max_rows' => 10, // maximum rows allowed, when reached the "new item" button will be hidden
        ]);

    }

    /**
     * Store a newly created resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // insert item in the db
        $item = $this->crud->create($this->crud->getStrippedSaveRequest());
        $this->data['entry'] = $this->crud->entry = $item;

        $this->crud->entry->update(['user_id'=>backpack_auth()->user()->id]);
        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
