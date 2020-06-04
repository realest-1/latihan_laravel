@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
                    @if (session()->get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif
    </div>

    <div class="my-1 p-3 bg-white rounded box-shadow">
        <div>
            @auth
                <a href="{{ route('article.create') }}" class="float-right badge badge-primary p-1">Add new</a>
            @endauth
            <h3 class="pb-0 mb-0">Recent articles</h3>
            <hr class="mt-3">
        </div>
        @foreach ($articleList as $article)

        <div class="media text-muted pt-2">
            <a href="#" id="{{ $article->id }}" name="pop">
                <img data-src="holder.js/64x64?theme=thumb&bg=007bff&fg=e83e8c&size=1" alt="" class="mr-2 rounded">
            </a>
            <div class="media-body">
                <span class="float-right badge badge-pill badge-light mt-1 mb-1">{{ $article->user_id }} at {{ $article->created_at }}</span>
                <h5 id="title{{ $article->id }}" href="#" class="media-heading d-block text-dark">{{ $article->title }}</h5>
                <div id="article{{ $article->id }}" class="media-body pb-0 mb-0 text-article" value='{{ $article->article }}'>
                    {!! strip_tags($article->article) !!}
                </div>
                @auth
                    @if ($article->user_id === Auth::id())
                        <form action="{{ route('article.destroy', $article->id) }}" method="post" id="delete{{ $article->id }}">
                            @csrf
                            @method('DELETE')
                                <a href="#" class="float-right badge badge-danger mx-1" onclick="return confirm('Are you sure delete this Article?'); this.parentNode.submit();">Delete</a>
                        </form>
                        <a href="{{ route('article.edit', $article->id) }}" class="float-right badge badge-success mx-1" id="edit{{ $article->id }}">Edit</a>
                    @endif
                @endauth
                <a href="#" id="{{ $article->id }}" class="float-right badge badge-info mx-1" name="pop">Read more</a>
                <hr class="mt-3">
            </div>
        </div>

        @endforeach

        <!-- Pagination -->
        <div class="pagination justify-content-center pt-3">
            {{ $articleList->links() }}
        </div>
    </div>

</div>

<!-- modal article read more -->
<div class="modal fade" id="artModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="artTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="artArticle">
            </div>
            <div class="modal-footer">
                @auth
                    <a class="btn btn-success" href="" id="artEdit">Edit</a>
                    <form action="" method="post" id="artDelete">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure to delete this?')">Delete</button>
                    </form>
                @endauth
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
@endsection
