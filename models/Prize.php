<?php

// namespace app\models;

// use yii\db\ActiveRecord;

// /**
//  * This is the model class for table "prizes".
//  *
//  * @property int $id
//  * @property string $name
//  * @property string $type
//  * @property float $amount
//  * @property string $item_name
//  */
// class Prize extends ActiveRecord
// {
//     const TYPE_MONEY = 'money';
//     const TYPE_POINTS = 'points';
//     const TYPE_PHYSICAL_ITEM = 'physical_item';

//     /**
//      * {@inheritdoc}
//      */
//     public static function tableName()
//     {
//         return 'prizes';
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function rules()
//     {
//         return [
//             [['name', 'type'], 'required'],
//             [['amount'], 'number'],
//             [['name', 'type', 'item_name'], 'string', 'max' => 255],
//         ];
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function attributeLabels()
//     {
//         return [
//             'id' => 'ID',
//             'name' => 'Name',
//             'type' => 'Type',
//             'amount' => 'Amount',
//             'item_name' => 'Item Name',
//         ];
//     }
// }