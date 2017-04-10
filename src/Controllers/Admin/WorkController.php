<?php

namespace Works\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Controller;
use URL;
use Route,
    Redirect;
use Works\Models\Works;
use Works\Models\WorksCategories;
use Works\Models\Templates;
//use Works\Models\WorksCategoryController;
/**
 * Validators
 */
use Works\Validators\WorkAdminValidator;

class WorkController extends WorkAdminController {

    public $data_view = array();
    private $obj_work = NULL;
    private $obj_work_category = NULL;
    private $obj_validator = NULL;
    public $obj_template = NULL;

    public function __construct() {
        $this->obj_work = new Works();
        $this->obj_work_category = new WorksCategories();
        $this->obj_template = new Templates();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $list_work = $this->obj_work->get_works($params);

        $this->data_view = array_merge($this->data_view, array(
            'works' => $list_work,
            'request' => $request,
            'params' => $params
        ));
        return view('work::work.admin.work_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $work = NULL;
        $work_id = (int) $request->get('id');


        if (!empty($work_id) && (is_int($work_id))) {
            $work = $this->obj_work->find($work_id);
        }

        $this->obj_work = new works();
        $templates = $this->obj_template->get_all_template();

        $this->data_view = array_merge($this->data_view, array(
            'work' => $work,
            'request' => $request,
            'templates' => $templates
        ));
        return view('work::work.admin.work_edit', $this->data_view)
                        ->with('category_parent', $this->obj_work_category->get_categories_parent(0));
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new workAdminValidator();

        $input = $request->all();

        $work_id = (int) $request->get('id');
        $work = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($work_id) && is_int($work_id)) {

                $work = $this->obj_work->find($work_id);
            }
        } else {
            if (!empty($work_id) && is_int($work_id)) {

                $work = $this->obj_work->find($work_id);

                if (!empty($work)) {

                    $input['work_id'] = $work_id;
                    $work = $this->obj_work->update_work($input);

                    //Message
                    $this->addFlashMessage('message', trans('work::work_admin.message_update_successfully'));
                    return Redirect::route("admin_work.edit", ["id" => $work->work_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('work::work_admin.message_update_unsuccessfully'));
                }
            } else {

                $work = $this->obj_work->add_work($input);

                if (!empty($work)) {

                    //Message
                    $this->addFlashMessage('message', trans('work::work_admin.message_add_successfully'));
                    return Redirect::route("admin_work.edit", ["id" => $work->work_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('work::work_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data_view = array_merge($this->data_view, array(
            'work' => $work,
            'request' => $request,
                ), $data);

        return view('work::work.admin.work_edit', $this->data_view)
                        ->with('category_parent', $this->obj_work_category->get_categories_parent(0));
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $work = NULL;
        $work_id = $request->get('id');

        if (!empty($work_id)) {
            $work = $this->obj_work->find($work_id);

            if (!empty($work)) {
                //Message
                //$this->addFlashMessage('message', trans('work::work_admin.message_delete_successfully'));

                $work->delete();
            }
        } else {
            
        }

        $this->data_view = array_merge($this->data_view, array(
            'work' => $work,
        ));

        return Redirect::route("admin_work");
    }

}
