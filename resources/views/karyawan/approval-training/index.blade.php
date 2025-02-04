@extends('layouts.karyawan')

@section('title', 'Business Trip')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Business Trip</h4> 
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="active">Business Trip</li>
                </ol>
            </div>
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12 p-l-0 p-r-0">
                <div class="white-box">
                    <div class="table-responsive">
                        <table id="data_table_no_pagging" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="70" class="text-center">#</th>
                                    <th>NIK</th>
                                    <th>NAME</th>
                                    <th>DEPARTMENT / POSITION</th>
                                    <th>ACTIVITY TYPE</th>
                                    <th>ACTIVITY TOPIC</th>
                                    <th>ACTIVITY DATE</th>
                                    <th>STATUS</th>
                                    <th>BILL</th>
                                    <th>CREATED</th>
                                    <th width="100">MANAGE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $item)
                                    @if(!isset($item->user->name))
                                        <?php continue; ?>
                                    @endif
                                    <tr>
                                        <td class="text-center">{{ $no+1 }}</td>  
                                        <td>{{ $item->user->nik }}</td>
                                        <td>{{ $item->user->name }}</a></td>
                                        <td>{{ empore_jabatan($item->user->id) }}</td> 
                                        <td>{{ $item->jenis_training }}</td>
                                        <td>{{ $item->topik_kegiatan }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tanggal_kegiatan_start)) }} - {{ date('d F Y', strtotime($item->tanggal_kegiatan_end)) }}</td>
                                        <td>
                                            <a onclick="status_approval_training({{ $item->id }})">
                                                @if($item->status == 1)
                                                    @if($item->is_approved_atasan == 1)
                                                        @if($item->status == 1)
                                                            <label class="btn btn-warning btn-xs">Waiting Approval</label>
                                                        @endif

                                                        @if($item->status == 2)
                                                            <label class="btn btn-success btn-xs">Approved</label>
                                                        @endif
                                                        @if($item->status == 3)
                                                            <label class="btn btn-danger btn-xs">Reject</label>
                                                        @endif
                                                    @else
                                                        @if($item->status == 2)
                                                            <label class="btn btn-success btn-xs">Approved</label>
                                                        @endif
                                                        @if($item->status == 3)
                                                            <label class="btn btn-danger btn-xs">Reject</label>
                                                        @endif
                                                    @endif
                                                @elseif($item->status == 2)
                                                    <label class="btn btn-success btn-xs">Approved</label>
                                                @elseif($item->status ==3)
                                                    <label class="btn btn-danger btn-xs">Reject</label>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            @if($item->status == 2)
                                                <a onclick="status_approval_actual_bill({{ $item->id }})"> 
                                                    @if($item->status_actual_bill == 2)

                                                        @if($item->is_approve_atasan_actual_bill == 1)
                                                            @if($item->approve_direktur_actual_bill === NULL)
                                                                <label class="btn btn-warning btn-xs">Waiting Approval</label>
                                                            @endif
                                                        @else
                                                            @if($item->is_approve_atasan_actual_bill == "")
                                                                <label class="btn btn-warning btn-xs">Waiting Approval Atasan</label>
                                                            @endif
                                                            @if($item->status_actual_bill == 3)
                                                                <label class="btn btn-success btn-xs">Approved</label>
                                                            @endif

                                                            @if($item->status_actual_bill == 4)
                                                                <label class="btn btn-danger btn-xs">Reject</label>
                                                            @endif
                                                        @endif
                                                        
                                                    @elseif($item->status_actual_bill == 3)
                                                        <label class="btn btn-success btn-xs">Approved</label>
                                                    @elseif($item->status_actual_bill == 3)
                                                        <label class="btn btn-danger btn-xs">Reject</label>
                                                    @endif
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if($item->status ==2)
                                                @if($item->status_actual_bill >= 2)

                                                    @if($item->is_approve_atasan_actual_bill == 1)
                                                        
                                                        @if($item->approve_direktur_actual_bill === NULL)
                                                         <a href="{{ route('karyawan.approval.training.biaya', ['id' => $item->id]) }}"> <button class="btn btn-info btn-xs m-r-5"><i class="fa fa-file"></i> Proses Actual Bill</button></a>
                                                        @endif

                                                        @if($item->approve_direktur_actual_bill == 1 || $item->approve_direktur_actual_bill === 0)
                                                            <a href="{{ route('karyawan.approval.training.biaya', ['id' => $item->id]) }}"> <button class="btn btn-info btn-xs m-r-5"><i class="fa fa-file"></i> Detail Actual Bill</button></a>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif


                                            @if($item->approve_direktur == 0)
                                                <a href="{{ route('karyawan.approval.training.detail', ['id' => $item->id]) }}"> <button class="btn btn-info btn-xs m-r-5">Proses <i class="fa fa fa-arrow-right"></i></button></a>
                                            @else
                                                <a href="{{ route('karyawan.approval.training.detail', ['id' => $item->id]) }}"> <button class="btn btn-info btn-xs m-r-5">Detail <i class="fa fa-search-plus"></i></button></a>
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
    @include('layouts.footer')
</div>
@endsection
