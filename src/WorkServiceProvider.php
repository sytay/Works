<?php

namespace Works;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use URL, Route;
use Illuminate\Http\Request;


class WorkServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        /**
         * Publish
         */
         $this->publishes([
            __DIR__.'/config/work_admin.php' => config_path('work_admin.php'),
        ],'config');

        $this->loadViewsFrom(__DIR__ . '/views', 'work');


        /**
         * Translations
         */
         $this->loadTranslationsFrom(__DIR__.'/lang', 'work');


        /**
         * Load view composer
         */
        $this->workViewComposer($request);

         $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';

        /**
         * Load controllers
         */
        $this->app->make('Works\Controllers\Admin\WorkController');

         /**
         * Load Views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'work');
    }

    /**
     *
     */
    public function workViewComposer(Request $request) {

        view()->composer('work::work*', function ($view) {
            global $request;
            $work_id = $request->get('id');
            $is_action = empty($work_id)?'page_add':'page_edit';

            $view->with('sidebar_items', [

                /**
                 * works
                 */
                //list
                trans('work::work_admin.page_list') => [
                    'url' => URL::route('admin_work'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
                //add
                trans('work::work_admin.'.$is_action) => [
                    'url' => URL::route('admin_work.edit'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],

                trans('work::work_category_admin.categories_list') => [
                    'url' => URL::route('admin_work_category'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
                //add
                trans('work::work_category_admin.'.$is_action) => [
                    'url' => URL::route('admin_work_category.edit'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
            ]);
            //
        });
    }

}
