<?php

namespace Works\Models;

use Illuminate\Database\Eloquent\Model;
use Works\Models\WorksCategories;

class works extends Model {

    
    protected $table = 'works';
    public $timestamps = false;
    protected $fillable = [
        'work_name',
        'work_description',
        'work_status',
        'work_category',
        'work_salary'
    ];
    protected $primaryKey = 'work_id';

    public function get_works($params = array()) {
        $eloquent = self::orderBy('work_id');

        if (!empty($params['work_name'])) {
            $eloquent->where('work_name', 'like', '%' . $params['work_name'] . '%');
        }
        $count = 0;
        $works = $eloquent->paginate(10);
        $obj_work_category = new WorksCategories();
        foreach ($works as $work) {
            if ($work->work_category == 0) {
                $works[$count]->category_name = "--";
            } else {
                $works[$count]->category_name = $obj_work_category->get_category_name($work->work_category);
            }
            $count++;
        }
        return $works;
    }

    /**
     *
     * @param type $input
     * @param type $work_id
     * @return type
     */
    public function update_work($input) {
        $work_id = NULL;
        if (empty($work_id)) {
            $work_id = $input['work_id'];
        }

        $work = self::find($work_id);

        if (!empty($work)) {

            $work->work_name = $input['work_name'];
            $work->work_category = $input['work_category'];
            $work->work_salary = $input['work_salary'];
            $work->work_description = $input['work_description'];

            $work->save();

            return $work;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_work($input) {

        $work = self::create([
                    'work_name' => $input['work_name'],
                    'work_category' => $input['work_category'],
                    'work_description' => $input['work_description'],
                    'work_salary' => $input['work_salary'],
        ]);
        return $work;
    }

}
