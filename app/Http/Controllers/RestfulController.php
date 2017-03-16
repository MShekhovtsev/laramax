<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RestfulController extends Controller
{
    public function __construct()
    {
        //todo: limit access to resource
    }

    /**
     * Return all model entities.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function all(Model $model)
    {
        return $model->all();
    }

    /**
     * Return filtered model entities.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, Model $model)
    {
        //
    }

    /**
     * Store a newly created entity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Illuminate\Database\Eloquent\Model  $model
     */
    public function create(Request $request, Model $model)
    {
        //todo: define validation rules
        $rules = [];

        $this->validate($request, $rules);

        $new = $model->create($request->all());
    }

    /**
     * Return the specified model entity.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model  $model
     */
    public function find(Model $model, $id)
    {
        return $model->find($id);
    }

    /**
     * Update the specified entity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model  $model
     */
    public function update(Request $request, Model $model, $id)
    {
        //todo: define validation rules
        $rules = [];

        $this->validate($request, $rules);

        $object = $model->find($id);

        $object->update($request->all());

        return $object;
    }

    /**
     * Remove the specified entity from storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model  $model
     */
    public function delete(Model $model, $id)
    {
        $object = $model->find($id);

        //todo: validate delete
        $object->delete();

        return $object;
    }
}
