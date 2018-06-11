@extends('layouts.index')
@section('titulo', 'Modulo  de configuracion')

@section('body')
        <div class="content mt-3">
            @if( \Session::has('error') )

                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">{{ \Session::get('error') }}</h4>
                </div>

            @endif
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Crear</strong>
                        </div>
                        <div class="card-body">
		               		<form action="{{ url('dashboard/tipos') }}" method="POST">
		               			@csrf
		               			@method('POST')
		               			<div class="form-row">
		               				<div class="col">
		               					<label for="codigo">Codigo</label>
		               					<input type="text" required name="codigo" maxlength="12" class="form-control form-control" id="codigo">
		               				</div>
		               				<div class="col">
		               					<label for="nombre">Nombre</label>
		               					<input type="text" required name="nombre_tipo"  class="form-control form-control" id="nombre">
		               				</div>
		               			</div>
		               			<div class="form-row">
		               				<div class="col">
			               				<label for="descripcion">Descripcion</label>
			               				<textarea name="descripcion" required id="descripcion" cols="2" rows="2" class="form-control"></textarea>
		               				</div>
		               			</div>
		               			<div class="form-row">
		               				<div class="col">
		               					<hr>
		               					<button class="btn btn-success">Guardar</button>
		               				</div>
		               			</div>
		               		</form>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
@endsection

@section('js')
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/datatables-init.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
@endsection