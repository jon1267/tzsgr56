<div class="col-md-4">

    <!-- alignment div -->
    <div class="my-4">
        <p class="h1">&nbsp;</p>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                @foreach($categories->chunk(3) as $catsChunk)
                <div class="col-lg-6">
                    @foreach($catsChunk as $category)
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#">{{ $category->title }}</a>
                            </li>
                        </ul>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Side Widget -->
    <div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
    </div>

    <!-- Comment Form -->
    <div class="my-4">
        <div id="comment-sec" class="text-center mt-10" >
            <a href="#" class="btn btn-success btn-block">WANT TO SAY SOMETHING ?
            </a>
            <br id="start-form-position">
            <form action="{{ route('comment.store') }}" method="post" id="leave_reply">
                @csrf
                <input id="comment_article_id" type="hidden" name="comment_article_id" value="{{$article->id}}">
                <input id="comment_parent" type="hidden" name="comment_parent" value="0">
                @if(!Auth::check())
                    <div class="col">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Name" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control" required="required" placeholder="Email address" />
                        </div>
                    </div>
                @endif
                <div class="col">
                    <div class="form-group">
                        <textarea name="text" id="text" required="required" class="form-control" rows="4" placeholder="Message"></textarea>
                    </div>
                </div>
                <div class="ajax_result"></div>
                <div class="col">
                    <button type="submit" id="submit" class="btn btn-danger">COMMENT NOW</button>
                </div>

            </form>
        </div>
    </div>

</div>