<?php

namespace Works\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Works\Models\Templates;

use Works\Validators\WorkAdminValidator;

class TemplateController extends WorkAdminController {

    public $obj_template = null;

    public function __construct() {
        $this->obj_template = new templates();
    }

    public function templates($name) {
        $template = $this->obj_template->get_template($name);
        return $template;
    }

}
