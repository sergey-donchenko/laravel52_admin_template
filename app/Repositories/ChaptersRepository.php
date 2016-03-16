<?php namespace App\Repositories;

use App\Models\Chapters as Chapters;
use Carbon\Carbon;

class ChaptersRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\Chapters $chapters
     *
     * @return void
    */
    public function __construct(Chapters $chapters)
    {
        $this->model = $chapters;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\Chapters $chapters
     *
     * @return
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Chapters $chapters
     *
     * @return
    */
    public function saveChapter( $chapter, $inputs )
    {
        $chapter->title        = $inputs['title'];
        $chapter->description  = $inputs['description'];
        $chapter->parent_id    = ( isset($inputs['parent_id']) ? $inputs['parent_id'] : null );
        $chapter->path         = ( isset($inputs['path']) ? $inputs['path'] : null );
        $chapter->pos          = ( isset($inputs['pos']) ? $inputs['pos'] : null );
        $chapter->is_active    = $inputs['is_active'];
        $chapter->type_chapter = ( isset($inputs['type_chapter']) ? $inputs['type_chapter'] : 0 );
        $chapter->date         = $inputs['date'];
        $chapter->number       = ( isset($inputs['number']) ? $inputs['number'] : null );
        $chapter->user_id      = 1/*Auth::id()*/;
        $chapter->icon        = ( isset($inputs['icon']) ? $inputs['icon'] : null );

        $chapter->save();

        return true;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        $chapters = $this->saveChapter( $model, $inputs );

        // some post creation actions will be required
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Chapters $chapters
     *
     * @return
    */
    public function edit( $id )
    {
        return $this->model->find($id);
    }

    /**
     * Destroy a message
     *
     * @param App\Models\Chapters
     *
     * @return void
    */
    public function destroy($chapters)
    {
        $chapters->delete();
    }
}