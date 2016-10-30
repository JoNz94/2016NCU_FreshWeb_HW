@extends('layout')
@section('content')
        <h1>留言板</h1>
        <p>最新流言  將會顯示在最上方</p>
        @if(Session::has('flash_message'))
            <div class="alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">

                @if(Session::has('flash_message_important'))
                    <button type="button" class="close" data-dismiss="alert" aria-hidden=true>&times;</button>
                @endif
                {{ Session::get('flash_message') }}
            </div>

        @endif
         <table  class="table">
            <thead>
                <tr><th>id</th><th>name</th><th>time</th>><th>content</th></tr>
            </thead>
            <tbody>
                @foreach( $messageBoards as $key => $messageBoard)
                    <script type="text/javascript">
                        var text = <?php echo $messageBoard->json; ?> ;
                        
                        
                        document.write(
                             "<tr><td></td><td>"+text.name+
                             "</td><td>"+text.time+
                             "</td><td>"+text.content+
                             "</td><td><label></label></td></tr>"
                        );
                    </script>
                    <tr><td>{{ $messageBoard->id }}</td>
                        <td>{{ $messageBoard->name }}</td>
                        <td>{{ $messageBoard->time }}</td>
                        <td>{{ $messageBoard->content }}</td>
                        


                        @if (\Auth::user() != null)


                            @if (\Auth::user()->name === $messageBoard->name)
                                <td><a href="/MessageBoard/{{ $messageBoard->id }}/edit" class="btn btn-default" style="float: left">修改</a>
                                    <form action="/MessageBoard/{{ $messageBoard->id }}" class="form_del" method="post" style="float: left">
                                    <input name="_method" type="hidden" value="DELETE"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <button type="submit" class="btn btn-default">刪除</button>
                                    </form>
                                </td>
                            @else
                                <td> <label></label></td>
                            @endif

                        @endif
                    </tr>

                    
                @endforeach
            </tbody>
        </table>
        <script type="text/javascript">
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
        </script>

       {!! $messageBoards->render() !!}
       @if (\Auth::user() != null)
        
        <div style="text-align:center;width:1000px;height:50px;">
                 <a href="MessageBoard/create" class="btn btn-default" >新增</a>
        </div>
        @endif
        
       
@stop