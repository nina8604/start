<?php

namespace App\Observers;

use App\Helpers\IModelFileManager;

class DeletingFileObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  IModelFileManager $model
     * @return void
     */
    public function created(IModelFileManager $model)
    {
        //
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  IModelFileManager $model
     * @return void
     */
    public function updated(IModelFileManager $model)
    {
        //
    }

    /**
     * Handle the category "deleting" event.
     *
     * @param  IModelFileManager $model
     * @return bool
     */
    public function deleting(IModelFileManager $model) {
        return $model->deleteFile();
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  IModelFileManager $model
     * @return void
     */
    public function deleted(IModelFileManager $model)
    {
        //
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  IModelFileManager $model
     * @return void
     */
    public function restored(IModelFileManager $model)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  IModelFileManager $model
     * @return void
     */
    public function forceDeleted(IModelFileManager $model)
    {
        //
    }
}
