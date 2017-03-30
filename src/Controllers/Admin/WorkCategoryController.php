<?php namespace Works\Controllers\Admin;

use Illuminate\Http\Request;
use Works\Controllers\Admin\WorkAdminController;
use URL;
use Route,
    Redirect;
use Works\Models\WorksCategories;
/**
 * Validators
 */
use Works\Validators\WorkCategoryAdminValidator;

class WorkCategoryController extends WorkAdminController {

    public $data_view = array();

    private $obj_work_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_work_category = new WorksCategories();
    }

    /**
     *
     * @return type
     */
    
    public function index(Request $request) {

        $params =  $request->all();

        $list_works_categories = $this->obj_work_category->get_categories($params);

        $this->data_view = array_merge($this->data_view, array(
            'works_categories' => $list_works_categories,
            'request' => $request,
            'params' => $params
        ));
        $categories = $this->obj_work_category->root_category();
        $allCategories = $this->obj_work_category->pluckSelect();
        return view('work::work_category.admin.work_category_list', $this->data_view, compact('categories','allCategories'));
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $category = NULL;
        $category_id = (int) $request->get('id');


        if (!empty($category_id) && (is_int($category_id))) {
            $category = $this->obj_work_category->find($category_id);

        }

        $this->data_view = array_merge($this->data_view, array(
            'category' => $category,
            'request' => $request
        ));
        return view('work::work_category.admin.work_category_edit', $this->data_view)
                ->with('category_parent', $this->obj_work_category->get_categories_parent($category_id));
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new WorkCategoryAdminValidator();

        $input = $request->all();

        $category_id = (int) $request->get('id');
        $category = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {
            
            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($category_id) && is_int($category_id)) {

                $category = $this->obj_work_category->find($category_id);
            }
            

        } else {
            if (!empty($category_id) && is_int($category_id)) {

                $category = $this->obj_work_category->find($category_id);

                if (!empty($category)) {

                    $input['category_id'] = $category_id;
                    $category = $this->obj_work_category->update_category($input);

                    //Message
                    $this->addFlashMessage('message', trans('work::work_admin.message_update_successfully'));
                    return Redirect::route("admin_work_category.edit", ["id" => $category->category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('work::work_admin.message_update_unsuccessfully'));
                }
            } else {
                $input['category_status'] = 1;
                
                $category = $this->obj_work_category->add_category($input);

                if (!empty($category)) {

                    //Message
                    $this->addFlashMessage('message', trans('work::work_admin.message_add_successfully'));
                    return Redirect::route("admin_work_category.edit", ["id" => $category->category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('work::work_admin.message_add_unsuccessfully'));
                }
            }
        }

        
        $this->data_view = array_merge($this->data_view, array(
            'category' => $category,
            'request' => $request,
            'category_parent' => $this->obj_work_category->get_categories_parent($category_id)
        ), $data);
        return view('work::work_category.admin.work_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $work = NULL;
        $work_id = $request->get('id');

        if (!empty($work_id)) {
            $work = $this->obj_work_category->find($work_id);

            if (!empty($work)) {
                  //Message
                $this->addFlashMessage('message', trans('work::work_admin.message_delete_successfully'));

                $work->delete();
            }
        } else {

        }

        $this->data_view = array_merge($this->data_view, array(
            'work' => $work,
        ));

        return Redirect::route("admin_work_category");
    }

}