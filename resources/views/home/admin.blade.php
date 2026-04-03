<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>ADMIN</title>
</head>

<body>
    <div class="container">
        <a class="btn btn-success" href="/">HOME</a>

        <form action="/admin/news/store" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="title" placeholder="Başlıq" class="form-control mb-2">

            <textarea name="content" class="form-control mb-2" placeholder="Xəbər mətni"></textarea>

            <input type="file" name="image" class="form-control mb-2">

            <button class="btn btn-primary" type="submit">Əlavə et</button>

        </form>

        <br><br><br><br><br>
        <hr><br><br><br>

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
                        <th>Əməliyyat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->content }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="" style="max-width:150px;">
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.deleteNews', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                </form>
                                <form action="{{ route('admin.news.editForm', $item->id) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Duzelt</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
    </div>

</body>

</html>