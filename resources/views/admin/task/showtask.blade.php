<table class="table table-striped">
    <tbody>
        <tr>
            <td>Judul Project : {{ucwords(strtolower($project->judul_project))}}</td>
        </tr>
        <tr>
            <td>Detail Project : {{$project->detail_project}}</td>
        </tr>
        <tr>
            <td>Tanggal Input : {{$project->tgl_input}}</td>
        </tr>
        <tr>
            <td>Total Revisi : {{ $project->total_revisi }} </td>
        </tr>
        <tr>
            <td>Prioritas : {{ $project->prioritas }} </td>
        </tr>
        <tr>
            <td class="d-flex justify-content-between align-items-center">
                <div class="d-flex w-25 justify-content-between">
                    <a href="{{ route('admin-task-single', ['id'=>$project->id, 'slug'=>$slug] ) }}" class="btn btn-info shadow btn-xs sharp mr-1" style="cursor: pointer;" data-bs-toggle="tooltip" title="Task details"><i class="fa fa-info" style="color:white"></i></a>
                    <a href="{{ route('admin-task-detail', ['id'=>$project->id]) }}" class="btn btn-success shadow btn-xs sharp mr-1" style="cursor: pointer;" data-bs-toggle="tooltip" title="Assignment collection details"><i class="fa fa-file" style="color:white"></i></a>
                    <a href="{{ route('admin-task-edit', ['id'=>$project->id]) }}" class="btn btn-primary shadow btn-xs sharp mr-1 px-2" data-bs-toggle="tooltip" title="Edit task"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger btn-delete shadow btn-xs sharp px-2" data-bs-toggle="tooltip" title="Delete task" data-id="{{ $project->id }}" style="cursor: pointer;"><i class="fa fa-trash" style="color:white"></i></a>
                </div>
            </td>
        </tr>
    </tbody>
</table>

<script src="{{ asset('public/js/tn.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
