  <div class="datagrid">
      @foreach ($fields as $key => $options)
          <div class="datagrid-item">
              <div class="datagrid-title">{{ $format($key, $info, $options, 'title') }}</div>
              <div class="datagrid-content">{!! $format($key, $info, $options) !!}</div>
          </div>
      @endforeach
  </div>
