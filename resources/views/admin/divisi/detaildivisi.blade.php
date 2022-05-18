<div class="container">

    @php
    $id = 91;
    @endphp

    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Team : {{ $division->nama_divisi; }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped display" style="min-width: 300px">
                            <thead>

                                <tr>
                                    <th>Team Leader : {{ $teamLeader->users->nama; }}</th>
                                </tr>
                                <tr>
                                    <th>Member</th>
                                </tr>
                            </thead>
                            <thead>
                            </thead>

                            <tbody>
                                @foreach ($teammate as $item)
                                <tr>
                                    <td>{{ $item->users->nama}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
