<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- Blog Post -->
        @forelse($articles as $article)
        <div class="card mb-4">
            <img class="card-img-top" src="{{ asset('blog/img/'.$article->img) }}" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{ $article->title }}</h2>
                <p class="card-text">{{ $article->description }} </p>
                <a href="{{ route('index.blogSingle', ['id' => $article->id]) }}" class="btn btn-primary">Read More &rarr;</a>
                <a href="{{ route('index.blogSingle', ['id' => $article->id]) }}" class="btn btn-success ml-2">Comments  <span class="badge badge-light ml-1"> {{ count($article->comments) }} </span> </a>
            </div>
            <div class="card-footer text-muted">
                Posted on {{ $article->created_at->format('F jS Y') }} by
                <a href="#">Start Bootstrap</a>
            </div>
        </div>
        @empty
            <div class="card mb-4">
                <p class="card-text">No data for display</p>
            </div>
        @endforelse


        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            {{ $articles->links() }}
        </ul>

    </div>

    <!-- Sidebar Widgets Column -->
    @include($sidebar)

</div>
<!-- /.row -->