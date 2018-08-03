@foreach($items as $item)
    <div id="comment-{{ $item->id }}" class="media">
        {{--<img class="mr-3 rounded" src="{{ asset('blog/img/user.gif') }}" alt="avatar pic" />--}}
        <img class="mr-3 rounded-circle" src="{{ asset('blog/img/user'.mt_rand(1,4)).'.gif' }}" alt="avatar pic" />
        <div class="media-body">
            <p class="small">
                @if($item->name)
                    {{ $item->name }}
                @else
                    {{ $item->user->name }}
                @endif
                &nbsp;&nbsp; {{ $item->created_at->format('jS F Y , H:i') }} says: <span class="commentNumber float-right">#</span>
            </p>
            <p id="item-text-{{ $item->id }}" class="item-text small">
                {{ $item->text }}
                <br>
                <a id="cancel-reply-{{$item->id}}" class="cancel-reply-link" href="#" onclick="return removeForm('{{$item->id}}')"> Cancel </a> {{--ссылка убрать ответ на комментарий--}}
                <a id="reply-{{$item->id}}" class="reply-link " href="#" onclick="return moveForm('{{$item->id}}')"> Reply </a> {{--ссылка ответить на комментарий--}}

            </p>

            {{--проверяем - есть ли ответы на корневой коммент, и если
                есть вставляем ссылку "показать ответы" "скрыть ответы". По нажатии
                показывать/скрывать дерево ответов на корневой комментарий (parent_id = 0)
            --}}
            <p class="small">
            @if(isset($com[$item->id]) && ($item->parent_id === 0))
                {{--<i class="fa fa-angle-up" aria-hidden="true"></i>--}}{{-- <i class="fa fa-angle-down" aria-hidden="true"></i>--}}
                <a id="hide-answers-{{ $item->id }}" class="hide-answers" href="#" onclick="return hideAnswers('{{$item->id}}')"> Hide answers &nbsp;&nbsp;&uarr;</a>
                <a id="show-answers-{{ $item->id }}" class="show-answers" href="#" onclick="return showAnswers('{{$item->id}}')"> Show answers &nbsp;&nbsp;&darr; </a>
            @endif
            </p>

            @if(isset($com[$item->id]))
                {{-- рекурсивный вызов шаблоном самого себя, но с др массивом коммента
                блога. Это - сдвинутый на (??? ~ 20px) дочерний коммент --}}
                <div id="child-{{ $item->id }}" class="">
                    @include('site.blog_single_comments', ['items'=>$com[$item->id]])
                </div>
            @endif

        </div>
    </div>
@endforeach