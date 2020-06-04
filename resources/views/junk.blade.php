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
    <table class="table table-striped">
        <thead>
          <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Article</td>
            <td colspan="3">Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($articleList as $article)
          <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->title}}</td>
            <td>{!! strip_tags($article->article) !!}</td>
            <td><a href="#" id="{{ $article->id }}" class="btn btn-primary" name="pop">View</a></td>
            <td>
                <form action="{{ route('article.restore', $article->id) }}" method="post">
                    @csrf
                    <button class="btn btn-success" type="submit">Restore</button>
                </form>
            </td>
            <td>
                <form action="{{ route('article.deletePermanently', $article->id) }}" method="post">
                    @csrf
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure to delete this?')">Delete Permanently</button>
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="pagination justify-content-center pt-3">
        {{ $articleList->links() }}
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
@endsection
