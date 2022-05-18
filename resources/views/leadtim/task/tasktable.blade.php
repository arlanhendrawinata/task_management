@extends('layouts.app')

@section('task', 'mm-active')
@section('title', '| Task')
@section('titleNav', 'Task')

@section('container.isi')
@section('active_leadtask', 'mm-active')

<style>
  .tasktable .th-date {
    width: 10px !important;
  }

  .tasktable th {
    font-size: 11px !important;
    width: 10px !important;
    padding: 10px 5px !important;
    text-align: center;

  }

  .tasktable .th-date {
    padding: 10px 3px !important;
    width: 100px;

  }

  .tasktable td {
    padding: 10px 4px !important;
    font-size: 11px;
    text-align: center;
  }

  .tasktable .th-target,
  .tasktable .th-result {
    width: 5px !important;
    padding: 10px 6px !important;

  }

  .box {
    background-color: green;
    width: 10px;
    height: 25px;
  }

  .card-body {
    padding: 0;
  }

  .content-body .container-fluid {
    padding-left: 20px;
    padding-right: 20px;
  }

  .infostatus {
    padding: 3px 7px;
    border-radius: 4px;
    font-size: 0.613rem;
    color: white;
    width: 90px;
    margin: 0 auto;
  }

  .info-success {
    background-color: #2bc155;
  }

  .info-info {
    background-color: #2f4cdd;
  }

  .info-danger {
    background-color: #f35757;
  }

  .wide-dialog {
    max-width: 100%;
    margin: 20px 20px;
  }

  .btn-select {
    padding: 0.525rem 1.2rem;
    font-size: 0.713rem;
  }

  .dropdown-menu {
    min-width: 0;
    padding: 0;
  }

  .dropdown-menu .dropdown-item {
    font-size: 0.813rem;
  }

  .bg-grey {
    background-color: #D2D6D9;
    color: #44494B;
  }

  .bg-teal {
    background-color: #20c997;

  }

  .bg-yellow {
    background-color: #FCE83A !important;
    color: #917217;
  }

  .bg-orange {
    background-color: #ff9900 !important;
  }

  .tasktable .td-task,
  .tasktable .td-keterangan {
    text-align: left;
    padding-left: 10px !important;
  }

  .btn-detail2:hover {
    color: #7e7e7e;
  }
</style>


<div class="container-fluid">
  <div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
      <div class="welcome-text">
        <h4>Hi, welcome back!</h4>
        <span>Datatable {{ $title }}</span>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header justify-content-between mx-2">
          <div>
            <a href="{{ route('admin-task-tambah') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle "></i> Add Task</a>
            <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#wideModal"> Fullscreen table</a>
          </div>
          <div class="d-flex">
            @php
            $url = url()->current();
            $parse = parse_url($url);
            @endphp

            @if(url()->current() == 'http://'.$parse["host"].'/admin/task/search')
            <div><a href="{{ route('admin-task-index') }}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-back "></i> Back</a></div>
            @endif
            <div class="ml-2">
              <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal"><i class="fa fa-filter mr-2"></i>Filter</a>
            </div>
          </div>
        </div>
        <div class=" card-body">
          <!-- task table -->
          <div class="table-bordered table-responsive">
            <table class="tasktable table table-striped">
              <thead>
                <tr class="tre">
                  <th>No</th>
                  <th>Client</th>
                  <th>Tanggal</th>
                  <th>Divisi</th>
                  <th>PIC</th>
                  <th>Task</th>
                  <th>T</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>R</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($projects as $item)
                <tr>
                  <td style="width: 3%;">{{ $item->clients->id }}</td>
                  <td style="width: 8%;">{{ $item->clients->nama_client }}</td>
                  <td style="width: 8%;">{{ $item->tgl_input }}</td>
                  <td style="width: 8%;">{{ $item->divisions->nama_divisi }}</td>
                  <td style="width: 8%;">
                    @foreach($pics as $pic)
                    @if($pic->project_id == $item->id)
                    {{ $pic->users->nama}}
                    @endif
                    @endforeach
                  </td>
                  <!-- <td class="td-task"><a class="btn-detail" data-bs-toggle="tooltip" title="Klik untuk lihat detail project" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}" data-attr="{{ route('admin-task-show', $item->id) }}">
                       $item->judul_project 
                    </a></td>
                  <td style="width: 3%;"> -->
                  <td class="td-task"><a href="{{ route('admin-task-single', ['id'=>$item->id]) }}" class="btn-detail2" data-bs-toggle="tooltip" title="Klik untuk lihat detail project">
                      {{ $item->judul_project }}
                    </a></td>
                  <td style="width: 3%;">
                    <?php
                    $date_estimasi = date("d/m/Y", strtotime($item->estimasi));
                    $day_estimasi = \Carbon\Carbon::createFromFormat('d/m/Y', $date_estimasi)->format('d');

                    $date_tglmulai = date("d/m/Y", strtotime($item->tgl_mulai));
                    $day_tglmulai = \Carbon\Carbon::createFromFormat('d/m/Y', $date_tglmulai)->format('d');

                    $estimasi = $day_estimasi - $day_tglmulai;
                    echo $estimasi;
                    ?>
                  </td>
                  <td style="width: 8%;">{{ $item->tgl_mulai }}</td>
                  <td style="width: 8%;">{{ $item->tgl_selesai }}</td>
                  <td style="width: 3%;">R</td>
                  <td class="td-keterangan">
                    {{ Str::limit($item->detail_project, 50) }}
                  </td>
                  <td class="td-status" style="width: 10%;">
                    <div class="infostatus bg-<?php
                                              if ($item->status == 1) {
                                                echo 'info';
                                              } elseif ($item->status == 2) {
                                                echo 'yellow';
                                              } elseif ($item->status == 3) {
                                                echo 'orange';
                                              } elseif ($item->status == 4) {
                                                echo 'teal';
                                              } elseif ($item->status == 5) {
                                                echo 'success';
                                              } elseif ($item->status == 6) {
                                                echo 'danger';
                                              } elseif ($item->status == 7) {
                                                echo 'red';
                                              } elseif ($item->status == 0) {
                                                echo 'grey';
                                              }
                                              ?>">
                      <?php
                      if ($item->status == 1) {
                        echo 'Active';
                      } elseif ($item->status == 2) {
                        echo 'Prcess';
                      } elseif ($item->status == 3) {
                        echo 'Submited';
                      } elseif ($item->status == 4) {
                        echo 'Approved';
                      } elseif ($item->status == 5) {
                        echo 'Success';
                      } elseif ($item->status == 6) {
                        echo 'Fail';
                      } elseif ($item->status == 7) {
                        echo 'Cancelled';
                      } elseif ($item->status == 0) {
                        echo 'Inactive';
                      }
                      ?>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td>No Datas</td>
                </tr>
                @endforelse
              </tbody>
            </table>
            <div class="mx-4 mt-4">
              {{ $projects->links() }}
            </div>
          </div>

          <!-- Filter Modal -->
          <form action="{{ route('admin-search') }}" method="get">
            <!-- @csrf -->
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Filter Task</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                  </div>
                  <div class="modal-body">
                    <div class="d-flex flex-column">
                      <div class="filter-date d-flex flex-column align-items-start ">
                        <h5 class="border-bottom mb-3 pb-3 w-100">By date</h5>
                        <div class="d-flex align-items-center">
                          <label class="" for="val-from_date">From date :</label>
                          <div class="col">
                            <input type="date" class="form-control" id="val-from_date" value="" name="from_date">
                          </div>
                          <label class="" for="val-to_date">To date :</label>
                          <div class="col">
                            <input type="date" class="form-control" id="val-to_date" value="" name="to_date">
                          </div>
                        </div>
                      </div>
                      <div class="filter-client mt-5">
                        <h5 class="border-bottom mb-3 pb-3">By client</h5>
                        <div class="d-flex align-items-center">
                          <label class="col-form-label" for="val-client">Client :
                          </label>
                          <div class="col-lg-6">
                            <select class="form-control" id="val-client" name="client">
                              <option value="">Please select client</option>
                              @forelse($clients as $client)
                              <option value="{{ $client->id }}">{{ $client->nama_client }}</option>
                              @empty
                              <option value="">No Datas</option>
                              @endforelse
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search mr-2"></i>Filter</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <!-- detail Modal -->
          <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                  <h5 class="modal-title" id="exampleModalLabel">Task details</h5>
                  <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                </div>
                <div class="modal-body" id="detailBody">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- end detail modal -->

          <!-- Wide Modal -->
          <div class="modal fade" id="wideModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog wide-dialog">
              <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                  <h5 class="modal-title" id="exampleModalLabel">Task Table</h5>
                  <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                </div>
                <div class="modal-body">
                  <div class="table-bordered table-responsive">
                    <table class="tasktable table table-striped">
                      <thead>
                        <tr class="tre">
                          <th>Client</th>
                          <th>Divisi</th>
                          <th>PIC</th>
                          <th>Project</th>
                          <th class="th-target">T</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>R</th>
                          <th class="th-status">Status</th>
                          @for($i = 1; $i <= 31; $i++) <th class="th-date">{{ $i }}</th> @endfor
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($projects as $item)
                        <tr>
                          <td>{{ $item->clients->nama_client }}</td>
                          <td>{{ $item->divisions->nama_divisi }}</td>
                          <td>@foreach($pics as $pic)
                            @if($pic->project_id == $item->id)
                            {{ $pic->users->nama}}
                            @endif
                            @endforeach
                          </td>
                          <td class="td-task" style="width: 15%;">{{ $item->judul_project }}</td>
                          <td>
                            <?php
                            $date_estimasi = date("d/m/Y", strtotime($item->estimasi));
                            $day_estimasi = \Carbon\Carbon::createFromFormat('d/m/Y', $date_estimasi)->format('d');

                            $date_tglmulai = date("d/m/Y", strtotime($item->tgl_mulai));
                            $day_tglmulai = \Carbon\Carbon::createFromFormat('d/m/Y', $date_tglmulai)->format('d');

                            $estimasi = $day_estimasi - $day_tglmulai;
                            echo $estimasi;
                            ?>
                          </td>
                          <td style="width: 6%;">{{ $item->tgl_mulai }}</td>
                          <td style="width: 6%;">{{ $item->tgl_selesai }}</td>
                          <td style="width: 2%;">R</td>
                          <td class="td-status" style="width: 8%;">
                            <div class="infostatus bg-<?php
                                                      if ($item->status == 1) {
                                                        echo 'info';
                                                      } elseif ($item->status == 2) {
                                                        echo 'yellow';
                                                      } elseif ($item->status == 3) {
                                                        echo 'orange';
                                                      } elseif ($item->status == 4) {
                                                        echo 'teal';
                                                      } elseif ($item->status == 5) {
                                                        echo 'success';
                                                      } elseif ($item->status == 6) {
                                                        echo 'danger';
                                                      } elseif ($item->status == 7) {
                                                        echo 'red';
                                                      } elseif ($item->status == 0) {
                                                        echo 'grey';
                                                      }
                                                      ?>">
                              <?php
                              if ($item->status == 1) {
                                echo 'Active';
                              } elseif ($item->status == 2) {
                                echo 'Process';
                              } elseif ($item->status == 3) {
                                echo 'Submited';
                              } elseif ($item->status == 4) {
                                echo 'Approved';
                              } elseif ($item->status == 5) {
                                echo 'Success';
                              } elseif ($item->status == 6) {
                                echo 'Fail';
                              } elseif ($item->status == 7) {
                                echo 'Cancelled';
                              } elseif ($item->status == 0) {
                                echo 'Inactive';
                              }
                              ?>
                            </div>
                          </td>
                          <?php
                          if ($item->tgl_selesai != null) {
                            $date = date("d/m/Y", strtotime($item->tgl_selesai));
                            $day_selesai = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('d');
                          } else {
                            $day_selesai = $item->tgl_selesai;
                          }
                          for ($i = 1; $i <= 31; $i++) {
                            if ($i == $day_selesai) {
                              if ($item->status == 4) {
                                echo '<td class=""><div class="box" style="background-color: blue; height: 40px;"></div></td>';
                              } elseif ($item->status == 2 or 1) {
                                echo '<td class=""><div class="box" style="background-color: #FCE83A; height: 40px;"></div></td>';
                              } elseif ($item->status == 5 or 6) {
                                echo '<td class=""><div class="box" style="background-color: red; height: 40px;"></div></td>';
                              }
                            } else {
                              echo '<td></td>';
                            }
                          }
                          ?>
                        </tr>
                        @empty
                        <tr>
                          <td>No Datas</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="mx-5">
                  {{ $projects->links() }}
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


@endsection