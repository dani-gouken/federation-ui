<div class="table-responsive">
    <table class="table table-vcenter card-table">
        @if ($isCollection)
            <thead>
                <tr>
                    @foreach ($fields as $key => $options)
                        <th>{{ $format($key, null, $options, 'title') }}</th>
                    @endforeach
                </tr>
            </thead>
        @else
            <thead>
                <tr>
                    <th>Champ</th>
                    <th>-</th>
                </tr>
            </thead>
        @endif
        <tbody>
            @if ($isCollection)
                @foreach ($info as $item)
                    <tr>
                        @foreach ($fields as $key => $options)
                            <td>{!! $format($key, $item, $options) !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            @else
                @foreach ($fields as $key => $options)
                    <tr>
                        <td>{{ $format($key, $info, $options, 'title') }}</td>
                        <td>{!! $format($key, $info, $options) !!}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
