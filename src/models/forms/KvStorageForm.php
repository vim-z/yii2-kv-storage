<?php


namespace vimZ\kvStorage\models\forms;


use vimZ\kvStorage\models\KvStorage;

class KvStorageForm extends KvStorage
{

    public function rules()
    {
        return [
            [['key', 'value', 'type', 'tip'], 'required'],

        ];
    }

    public function scenarios()
    {
        return [
            ''
        ];
    }
}