<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration {

    private $_table = NULL;
    private $fileds = NULL;

    public function __construct() {
        $this->_table = 'templates';
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        /**
         * Existing table
         */
        if (!Schema::hasTable($this->_table)) {
            Schema::create($this->_table, function (Blueprint $table) {
                $table->increments('template_id');
                $table->string('template_name');
                $table->string('template_content');
                $table->integer('template_status');
            });
        }

        /**
         * Existing fields
         */
        //site_id
        if (!Schema::hasColumn($this->_table, 'template_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->increments('template_id');
            });
        }
        //site_name
        if (!Schema::hasColumn($this->_table, 'template_name')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->string('template_name', 255);
            });
        }
        
        //site_url
        if (!Schema::hasColumn($this->_table, 'template_content')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->string('template_content', 255);
            });
        }
        
        //site_url
        if (!Schema::hasColumn($this->_table, 'template_status')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->string('template_status', 255);
                 $table->default(1);
            });
        }

 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('templates');
    }

}
