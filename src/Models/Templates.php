<?php

namespace Works\Models;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    protected $table = 'templates';
    public $timestamps = false;
    protected $fillable = [
        'template_name',
        'template_status',
        'template_content',
        
    ];
    protected $primaryKey = 'template_id';
    
    public function get_template($id) {
        $template = self::where('template_id', $id)->get();
        return $template[0]->template_content;
    }
    
    public function get_all_template() {
        $template = self::get();
        return $template;
    }
}
