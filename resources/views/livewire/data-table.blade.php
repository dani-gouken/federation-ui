<div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="spinner-grow" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
                {{ $info->showTitle ? $info->name : '' }}
                <div class="btn-group ms-auto" role="group">
                    @foreach ($info->actions as $name => $action)
                        <a href="{{ $action['url'] }}" class="btn btn-small btn-primary">
                            <i class="ti ti-{{ $action['icon'] }}"></i>&nbsp;
                            {{ $name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                            <input wire:loading.attr="disabled" wire:model.blur="perPage" type="text"
                                class="form-control form-control-sm" value="{{ $pagination->perPage() }}"
                                size="3">
                        </div>
                        entries
                    </div>
                    <div class="ms-auto text-muted">
                        Search:
                        <div class="ms-2 d-inline-block">
                            <input wire:model.blur="query" wire:loading.attr="disabled" type="text"
                                class="form-control form-control-sm" aria-label="Search invoice">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                    aria-label="Select all invoices"></th>
                            <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d=" M0 0h24v24H0z" fill="none" />
                                    <path d="M6 15l6 -6l6 6" />
                                </svg>
                            </th>
                            @foreach ($info->titles() as $title)
                                <th>{{ $title }}</th>
                            @endforeach
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagination as $item)
                            <tr>
                                <td>
                                    <input class="form-check-input m-0 align-middle" type="checkbox"
                                        aria-label="Select {{ $info->name }}">
                                </td>
                                <td>{{ $item->id }}</td>
                                @foreach ($info->formatted($item) as $value)
                                    <td>{!! $value !!}</td>
                                @endforeach
                                <td class="text-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @foreach ($item->datatableActions(request()) as $action)
                                            @if ($action['method'] ?? false)
                                                <form action="{{ $action['url'] }}" method="POST"
                                                    @if ($action['confirmed'] ?? false) data-confirm="Êtes vous sure?" @endif>
                                                    @csrf
                                                    @method($action['method'])
                                                    <button type="submit"
                                                        class="btn btn-md btn-{{ $action['theme'] }}">
                                                        <i class="ti ti-{{ $action['icon'] }}"></i>&nbsp;
                                                        {{ $action['name'] }}
                                                    </button>
                                                </form>
                                            @else
                                                <a @if ($action['confirmed'] ?? false) data-confirm="Êtes vous sure?" @endif
                                                    class="btn btn-md btn-{{ $action['theme'] }}"
                                                    href="{{ $action['url'] }}">
                                                    <i class="ti ti-{{ $action['icon'] }}"></i>&nbsp;
                                                    {{ $action['name'] }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $pagination->links() }}
            </div>
        </div>
    </div>
</div>
