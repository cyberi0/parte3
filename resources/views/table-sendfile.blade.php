<table class="table">
    <thead>
    <tr>
        @foreach ($Columns as $column)
        <th scope="col">{{$column}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach ($Rows as $t=>$row)
            <tr>
            @foreach ($row as $r)
                <td>{{$r}}</td>
            @endforeach
                <th scope="row">{{$temps[$t]}}º</th>
            </tr>
        @endforeach
    </tbody>
</table>
