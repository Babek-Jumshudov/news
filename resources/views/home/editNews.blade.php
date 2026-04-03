<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT</title>
</head>

<body>

    @extends('layouts.admin')

    @section('content')
        <div class="container mt-4">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Başlıq</th>
                        <th>Məzmun</th>
                        <th>Şəkil</th>
                        <th>Əməliyyatlar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $index => $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->content }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="" style="max-width:150px;">
                                @endif
                            </td>
                            <td>
                                <!-- Sil düyməsi -->
                                <form action="{{ route('news.delete', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                </form>

                                <!-- Redaktə düyməsi: form row-un içində gizli -->
                                <button class="btn btn-warning btn-sm" type="button"
                                    onclick="document.getElementById('edit-form-{{ $item->id }}').classList.toggle('d-none')">
                                    Redaktə et
                                </button>

                                <!-- Redaktə Formu -->
                                <div id="edit-form-{{ $item->id }}" class="mt-2 d-none">
                                    <form action="{{ route('admin.news.edit', $item->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-2">
                                            <input type="text" name="title" value="{{ $item->title }}" class="form-control"
                                                required>
                                        </div>
                                        <div class="mb-2">
                                            <textarea name="content" class="form-control" rows="3"
                                                required>{{ $item->content }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <input type="file" name="image" class="form-control">
                                            @if($item->image)
                                                <img src="{{ asset($item->image) }}" alt=""
                                                    style="max-width:100px; margin-top:5px;">
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Yadda saxla</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $news->links() }} <!-- Pagination -->
            </div>
        </div>
    @endsection


</body>

</html>