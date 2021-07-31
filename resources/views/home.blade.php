@extends('layouts.master')
@section('content')
    <div class="container mt-4">
        <form method="POST" action="{{ url('/addTodo') }}" class="row">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="col-sm-9 form-group">
                <label class="font-weight-bold" for="todo_title">Yapılacak İş</label>
                <input type="text" class="form-control" name="todo_title" id="todo_title" placeholder="Yapılacak İş">
            </div>
            <div class="col-sm-3 m-auto">
                <button class="btn btn-dark mt-3 w-100">Ekle</button>
            </div>
        </form>
        <table class="table table-striped table-inverse  w-100">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th class="text-center">İş Adı</th>
                    <th class="text-center">Durum</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todo_list as $key => $value)
                    <tr>
                        <td scope="row">#{{ $key + 1 }}</td>
                        <td class="text-center">{{ $value->title }}</td>
                        <td class="text-center">
                            <input type="checkbox" id="changeButton" class="w-100 changeButton"
                                data-id="{{ $value->id }}" {{ $value->status == 1 ? 'checked' : '' }}
                                data-toggle="toggle">
                        </td>
                        <td><a href="{{ url('/deleteTodo/' . $value->id) }}" class="btn btn-danger w-100">Sil</a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
        $(function() {
            $('.changeButton').bootstrapToggle({
                on: 'Tamamlandı',
                off: 'Tamamlanmadı'
            });
            $('.changeButton').change((e) => {
                var id = e.target.dataset.id;
                fetch(`/changeStatusTodo/${id}`);
            });
            let searchParams = new URLSearchParams(window.location.search)
            if (searchParams.get("qo") == "error") {
                swal({
                    title: "Hata!",
                    text: "Lütfen boş birşey göndermeyin!",
                    icon: "error",
                });
            }

        })
    </script>
@endsection
