<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- Blog Article -->
        <div class="card mb-4">
            <img class="card-img-top" src="{{ asset('blog/img/'.$article->img) }}" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{ $article->title }}</h2>
                <p class="card-text">
                    {!! $article->text !!}
                </p>
            </div>
            <div class="card-footer text-muted">
                Posted on {{ $article->created_at->format('F jS Y') }} by
                <a href="#">Start Bootstrap</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <p class="h3">Recent Comments :</p>

                @if(count($article->comments))
                
                    @foreach($com as $key => $comments)
                        @if($key !==0)
                            @break
                        @endif
                        @include('site.blog_single_comments', ['items'=>$comments])
                    @endforeach
                    <div id="start" class="insert_new_parent_comment"></div> <!-- для родительских комментариев вставл ajax см jon_scripts.js -->

                @else
                    <div id="start" class="insert_new_parent_comment"></div> <!-- для родительских комментариев вставл ajax см jon_scripts.js -->
                @endif

            </div>
        </div>



    </div>

    <!-- Sidebar Widgets Column -->
    @include($sidebar)

</div>

{{--<div class="row">
    <div class="col">
        <div class="card mb-4">
            <div class="card-body">
                <p class="h3">Recent Comments :</p>

                @if(count($article->comments))
                
                    @foreach($com as $key => $comments)
                        @if($key !==0)
                            @break
                        @endif
                        @include('site.blog_single_comments', ['items'=>$comments])
                    @endforeach
                @else

                @endif

            </div>

        <!-- кнопа вернутья...? хз -->
        <a href="{{ route('index.blogHome') }}" class="btn btn-primary">&larr; Back </a>

        </div>
    </div>
</div>--}}
<!-- /.row -->