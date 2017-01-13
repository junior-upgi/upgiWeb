<div class="list-group table-of-content">
    <a class="list-group-item" href="{{ url('/production/today') }}">當日生產線一覽</a>
    <a class="list-group-item" href="{{ url('/production/info') }}">瓶號生產資料庫</a>
    @if (request()->ip() == '192.168.10.1')
        <a class="list-group-item" href="{{ url('/production/importToday') }}">當日生產線資料管理</a>
        <a class="list-group-item" href="{{ url('/production/importGlass') }}">瓶號生產資料庫管理</a>
    @endif
</div>