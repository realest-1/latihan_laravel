@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="card">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div><br />
            @endif
            <h5 class="card-header">Edit Article</h5>
            <div class="card-body">
                <form action="{{ route('article.update', $article->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" id="user_id" name="user_id" value=1>
                    <div class="form-group">
                        <label for="title" class="col-form-label">Title</label>
                        <input class="form-control" type="text" id="title" name="title" value="{{ $article->title }}"/>
                    </div>
                    <div class="form-group">
                        <label for="article" class="col-form-label">Article</label>
                        <textarea name="article" id="article" cols="60" rows="50">{{ $article->article }}</textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Edit" />
                    </div>
                </form>
            </div>
        </div>

    </div>

<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
<script>
	ClassicEditor
		.create( document.querySelector( '#article' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>
@endsection
