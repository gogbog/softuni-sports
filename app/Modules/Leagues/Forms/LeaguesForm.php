<?php

namespace App\Modules\Leagues\Forms;

use Charlotte\Administration\Forms\AdminForm;
use Charlotte\Administration\Helpers\AdministrationSeo;

class LeaguesForm extends AdminForm {

    public function buildForm() {

        $this->add('title', 'text', [
            'title' => trans('leagues::admin.title'),
            'clone' => ['slug'],
        ]);

        AdministrationSeo::seoFields($this, $this->model, false, ['slug']);


        $this->add('visible', 'switch', [
            'title' => trans('leagues::admin.visible'),
            'class' => 'col-md-1',
            'default_value' => 1
        ]);


        $this->add('submit', 'button', [
            'title' => trans('administration::admin.submit')
        ]);
    }
}