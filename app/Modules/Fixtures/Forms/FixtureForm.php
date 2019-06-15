<?php

namespace App\Modules\Fixtures\Forms;

use Charlotte\Administration\Forms\AdminForm;
use Charlotte\Administration\Helpers\AdministrationSeo;

class FixtureForm extends AdminForm {

    public function buildForm() {

        $this->add('title', 'text', [
            'title' => trans('leagues::admin.title'),
            'clone' => ['slug'],
        ]);

        AdministrationSeo::seoFields($this, $this->model, false, ['slug']);

        $this->add('date', 'date', [
            'title' => trans('fixtures::admin.date'),
        ]);

        $this->add('homeTeamOdds', 'text', [
            'title' => trans('fixtures::admin.homeTeamOdds'),
        ]);

        $this->add('awayTeamOdds', 'text', [
            'title' => trans('fixtures::admin.awayTeamOdds'),
        ]);

        $this->add('drawOdds', 'text', [
            'title' => trans('fixtures::admin.drawOdds'),
        ]);


        $this->add('visible', 'switch', [
            'title' => trans('fixtures::admin.visible'),
            'class' => 'col-md-1',
            'default_value' => 1
        ]);


        $this->add('submit', 'button', [
            'title' => trans('administration::admin.submit')
        ]);
    }
}