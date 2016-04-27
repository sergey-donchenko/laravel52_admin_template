<div class="form-group">
    {{ Form::label('title', Lang::get('news.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control convert-to-url')) }}
</div>

<div class="form-group">
    {{ Form::label('url', Lang::get('news.form.url') ) }}
    {{ Form::text('url', ( isset($oData) ? $oData->url : null), array('class' => 'form-control data-url', 'readonly' => true)) }}
</div>

<div class="form-group">
    {{ Form::label('date', Lang::get('table_field.lists.date')) }}
    <div class="input-group date-group">
        {{ Form::text('date', ( isset($oData) ? get_formatted_date($oData->date) : get_current_date() ), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('content', Lang::get('news.form.content') ) }}
    {{ Form::textarea('content', ( isset($oData) ? $oData->content : null), array('class' => 'form-control ck-edtor')) }}
</div>

<div class="form-group">
    {{ Form::label('tags', Lang::get('news.form.tags') ) }}
    {{ Form::text('tags', ( isset($oData) ? $oData->tags : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('chapter_id', Lang::get('news.form.chapter') ) }}
    {{ Form::select('chapter_id', $aChapters, ( isset($oData) ? $oData->chapter_id : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('source', Lang::get('news.form.source') ) }}
    {{ Form::text('source', ( isset($oData) ? $oData->source : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('photo', Lang::get('news.form.photo')) }}
    {{ Form::file('image', array() ) }}
    @if ( isset($oData) && $oData->photo)
        <img src="{{ get_file_url($oData->photo, 'box2') }}" title="{{ $oData->title }}" class="img-responsive img-thumbnail">
    @endif
</div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}