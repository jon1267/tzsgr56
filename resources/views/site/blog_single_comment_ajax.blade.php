{{--
  это шаблон 1-ного коммента блога добавляемого через ajax... не путать
  с шаблоном blog_single_commens это разные шаблоны.
  (они похожи но этот делается под ajax, и тут на входе $data[] - не коллекция )
--}}
@if(isset($data))
    <div id="comment-{{ $data['id'] }}" class="media">
        {{--<img class="mr-3 rounded" src="{{ asset('blog/img/user.gif') }}" alt="avatar pic" />--}}
        <img class="mr-3 rounded-circle" src="{{ asset('blog/img/user'.mt_rand(1,4)).'.gif' }}" alt="avatar pic" />
        <div class="media-body">
            <p class="small">
                @if($data['name'])
                    {{ $data['name'] }}
                @endif
                &nbsp;&nbsp; says: <span class="commentNumber float-right">#{{ $data['id'] }}</span>
            </p>

            <p id="item-text-{{ $data['id']}}" class="item-text small">
                {{ $data['text'] }}
                <br>
                <a id="cancel-reply-{{$data['id']}}" hidden class="cancel-reply-link" href="#" onclick="return removeForm('{{$data['id']}}')"> Cancel </a> {{--ссылка убрать ответ на комментарий--}}
                <a id="reply-{{$data['id']}}" class="reply-link" href="#" onclick="return moveForm('{{$data['id']}}')"> Reply </a> {{--ссылка ответить на комментарий--}}
            </p>
        </div>
    </div>
@endif