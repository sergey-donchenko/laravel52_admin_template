<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\VacanciesRequest;
use App\Repositories\VacanciesRepository;
use App\Repositories\ChaptersRepository;

use App\Http\Requests;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Config;

class VacanciesController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\VacanciesRepository
     */
    protected $vacancies;

    /**
     * Create a new NewsController instance
     *
     * @param App\Repositories\VacanciesRepository
     *
     * @return void
     */
    public function __construct( VacanciesRepository $vacancies )
    {
        $this->vacancies = $vacancies;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-th-list"></i>', 'title' => Lang::get('vacancies.lists.lists_vacancies'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('vacancies.lists.vacancies_management'),
            'sSubTitle' => Lang::get('vacancies.lists.vacancies_management_online'),
            'sBoxTitle' => Lang::get('vacancies.lists.lists_vacancies'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('vacancies.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.vacancies.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_vacancies')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit_vacancies', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.vacancies.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete_vacancies', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.vacancies.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.vacancies.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh_vacancies', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.vacancies.index') )
                    )
                )
            ))
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.vacancies.index'), 'icon' => '<i class="fa fa-th-list"></i>', 'title' => Lang::get('vacancies.lists.lists_vacancies')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('vacancies.lists.create_vacancies'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('vacancies.lists.vacancies_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('vacancies.lists.create_new_vacancies'),
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.vacancies.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('vacancies.add', array(
                'oData' => null
            )),
            'formUrl' => URL::route('admin.vacancies.store'),
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( VacanciesRequest $request )
    {
        $this->vacancies->store( $request->all() );

        return Redirect::route('admin.vacancies.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('vacancies.lists.vacancies_saved_successfully') ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.vacancies.index'), 'icon' => '<i class="fa fa-th-list"></i>', 'title' => Lang::get('vacancies.lists.lists_vacancies')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('vacancies.lists.editing_vacancies'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('vacancies.lists.vacancies_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('vacancies.lists.editing_vacancies'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.vacancies.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('vacancies.add', array(
                'oData' => $this->vacancies->edit( $id )
            )),
            'formUrl' => URL::route('admin.vacancies.store'),
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
