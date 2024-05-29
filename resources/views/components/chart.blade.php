<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.ApexCharts && (new ApexCharts(document.getElementById('{{ $id }}'),
            {!! json_encode($options) !!})).render();
    });
</script>
<div id="{{ $id }}"></div>
