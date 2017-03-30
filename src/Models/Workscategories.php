<?php

namespace Works\Models;

use Illuminate\Database\Eloquent\Model;

class WorksCategories extends Model {

    protected $table = 'works_categories';
    public $timestamps = false;
    protected $fillable = [
        'category_name',
        'category_parent',
        'category_desciption',
        'category_status',
    ];
    protected $primaryKey = 'category_id';

    public function get_category_name($category_id) {
        $category = self::where('category_id', $category_id)->get();
        return $category[0]->category_name;
    }

    public function get_categories($params = array()) {
        $eloquent = self::orderBy('category_id');

        if (!empty($params['category_name'])) {
            $eloquent->where('category_name', 'like', '%' . $params['category_name'] . '%');
        }
        $works_categories = $eloquent->paginate(10);
        $count = 0;
        foreach ($works_categories as $work_category) {
            if ($work_category->category_parent == 0) {
                $works_categories[$count]->category_parent_name = "--";
            } else {
                $category = self::where('category_id', $work_category->category_parent)->get();
                $category_name = $category[0]->category_name;
                $works_categories[$count]->category_parent_name = $category_name;
            }
            $count++;
        }
        return $works_categories;
    }

    public function get_categories_parent($category_id) {
        $works_categories = $this->where('category_id', '!=', $category_id)->get();
        $list = NULL;
        $list[0] = "Uncategorized";
        $this->get_childs_category($works_categories, 0, $list, 0);
        
        return $list;
    }

    public function get_childs_category($works_categories, $category_parent, &$list, $level) {
        foreach ($works_categories as $category) {
            if ($category->category_parent == $category_parent) {
                $name = $category->category_name;
                $list[$category->category_id] = $name;
                $next_level = $level + 1;
                $this->get_childs_category($works_categories, $category->category_id, $list, $next_level);
            }
            
        }
    }

    public function childs() {
        return $this->hasMany('Works\Models\WorksCategories', 'category_parent', 'category_id');
    }

    public function root_category() {
        return $this->where('category_parent', '=', 0)->get();
    }

    /**
     *
     * @param type $input
     * @param type $work_id
     * @return type
     */
    public function update_category($input, $category_id = NULL) {

        if (empty($category_id)) {
            $category_id = $input['category_id'];
        }

        $category = self::find($category_id);

        if (!empty($category)) {

            $category->category_name = $input['category_name'];
            $category->category_parent = $input['category_parent'];
            $category->category_description = $input['category_description'];
            $category->save();

            return $category;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_category($input) {

        $category = self::create([
                    'category_name' => $input['category_name'],
                    'category_parent' => $input['category_parent'],
                    'category_description' => $input['category_description'],
                    'category_status' => $input['category_status'],
        ]);
        return $category;
    }

    /**
     * Get list of works categories
     * @param type $category_id
     * @return type
     */
    public function pluckSelect() {
        return $this->pluck('category_name', 'category_id')->all();
    }

}
