<?php namespace Shohabbos\Payeer\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateShohabbosPayeerTransactions extends Migration
{
    public function up()
    {
        Schema::create('shohabbos_payeer_transactions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('m_operation_id');
            $table->string('m_operation_ps')->nullable();
            $table->string('m_operation_date')->nullable();
            $table->string('m_operation_pay_date')->nullable();
            $table->string('m_shop')->nullable();
            $table->string('m_orderid')->nullable();
            $table->string('m_amount')->nullable();
            $table->string('m_curr')->nullable();
            $table->string('m_desc')->nullable();
            $table->string('m_status')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shohabbos_payeer_transactions');
    }
}
