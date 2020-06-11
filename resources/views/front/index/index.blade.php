@foreach ($data as $vo)
<a href="/view?id={{$vo->id}}">{{$vo->title}}</a><hr/>
@endforeach