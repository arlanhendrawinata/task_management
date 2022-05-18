<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Team : {{ $divisi->nama_divisi  }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped display" style="min-width: 445px">
                        <tbody>
                            @foreach ($isiTeam as $item)
                            <tr>
                                <td>

                                    {{ $item->users->nama }}
                                    @if($item->role == 3)
                                    {{' (Leader)'}}
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
