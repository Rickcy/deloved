<?php

use yii\db\Migration;

class m170111_142425_item extends Migration
{

    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }



        $this->createTable('{{%delivery_methods}}',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()
        ],$tableOptions);


        $this->createTable('{{%condition}}',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()
        ],$tableOptions);

        $this->createTable('{{%payment_methods}}',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()
        ],$tableOptions);



        $this->createTable('{{%photo}}',[
            'id'=>$this->primaryKey(),
            'image_name'=>$this->string(),
            'file'=>$this->string()
        ],$tableOptions);

        $this->createTable('{{%goods}}',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'price'=>$this->double(),
            'model'=>$this->string(),
            'description'=>$this->text(),
            'availability'=>$this->integer()->notNull(),
            'rating_count'=>$this->integer()->defaultValue(0),
            'rating_good'=>$this->integer()->defaultValue(0),
            'condition_id'=>$this->integer(),
            'payment_methods_id'=>$this->integer(),
            'delivery_methods_id'=>$this->integer(),
            'account_id'=>$this->integer()->notNull(),
            'category_type_id'=>$this->integer()->notNull(),
            'category_id'=>$this->integer()->notNull(),
            'date_created'=>$this->integer(),
            'show_main'=>$this->integer()->defaultValue(0),
            'photo_id'=>$this->integer(),
            'measure_id'=>$this->integer()->notNull(),
            'currency_id'=>$this->integer()->notNull()

        ],$tableOptions);


        $this->createIndex('fk_good_currency_id','{{%goods}}','currency_id');
        $this->addForeignKey('fk_good_currency_id','{{%goods}}','currency_id','{{%currency}}','id','CASCADE','CASCADE');




        $this->createIndex('fk_good_measure_id','{{%goods}}','measure_id');
        $this->addForeignKey('fk_good_measure_id','{{%goods}}','measure_id','{{%measure}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_good_photo_id','{{%goods}}','photo_id');
        $this->addForeignKey('fk_good_photo_id','{{%goods}}','photo_id','{{%photo}}','id','CASCADE','CASCADE');




        $this->createIndex('fk_good_category_id','{{%goods}}','category_id');
        $this->addForeignKey('fk_good_category_id','{{%goods}}','category_id','{{%category}}','id','CASCADE','CASCADE');




        $this->createIndex('fk_good_category_type_id','{{%goods}}','category_type_id');
        $this->addForeignKey('fk_good_category_type_id','{{%goods}}','category_type_id','{{%category_type}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_good_account_id','{{%goods}}','account_id');
        $this->addForeignKey('fk_good_account_id','{{%goods}}','account_id','{{%account}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_good_delivery_methods_id','{{%goods}}','delivery_methods_id');
        $this->addForeignKey('fk_good_delivery_methods_id','{{%goods}}','delivery_methods_id','{{%delivery_methods}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_good_payment_methods_id','{{%goods}}','payment_methods_id');
        $this->addForeignKey('fk_good_payment_methods_id','{{%goods}}','payment_methods_id','{{%payment_methods}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_good_condition_id','{{%goods}}','condition_id');
        $this->addForeignKey('fk_good_condition_id','{{%goods}}','condition_id','{{%condition}}','id','CASCADE','CASCADE');


    }

    public function safeDown()
    {
    }

}