@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row justify-content-center ">

      <div class="col-md-8">
        @if (session('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        @endif
        <div class="card-group">
          <div class="card">

            <div class="card-header">
              @if (isset($paymentcategory) && is_object($paymentcategory))
                Modificar Categoría de Pago
              @else
                Nueva Categoría de Pago
              @endif
            </div>

            <div class="card-body">

              <form id="gradeForm" method="POST"
                action="{{ isset($paymentcategory) ? route('paymentcategory.update') : route('paymentcategory.store') }}"
                enctype="multipart/form-data" aria-label="Grados">
                {{ csrf_field() }}


                @if (isset($paymentcategory) && is_object($paymentcategory))
                  <input type="hidden" name="id" value="{{ $paymentcategory->id }}" /><br>
                @endif

                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                      value="{{ $paymentcategory->name ?? '' }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>


                <div class="form-group row">
                  <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                  <div class="col-md-6">
                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                      name="description" value="{{ $paymentcategory->description ?? '' }}" required
                      autocomplete="description" autofocus>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="payment_date" class="col-md-4 col-form-label text-md-right">Fecha a realizar el pago</label>

                  <div class="col-md-6">
                    <input id="payment_date" type="date" class="form-control @error('payment_date') is-invalid @enderror"
                      name="payment_date" value="{{ $paymentcategory->payment_date ?? '' }}" required
                      autocomplete="payment_date" autofocus>

                    @error('payment_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="amount" class="col-md-4 col-form-label text-md-right">Total a cancelar</label>

                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Q.</span>
                      </div>
                      <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror"
                        name="amount" value="{{ $paymentcategory->amount ?? '' }}" required autocomplete="amount"
                        autofocus>
                    </div>
                    @error('amount')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('paymentcategory.index') }}" class="btn btn-outline-secondary">Cancelar</a>

                    <button type="submit" class="btn btn-primary">
                      @if (isset($paymentcategory) && is_object($paymentcategory))
                        Actualizar
                      @else
                        Guardar
                      @endif
                    </button>

                    @if (isset($paymentcategory) && is_object($paymentcategory))
                    <a href="{{ action('PaymentcategoryController@destroy', ['id' => $paymentcategory->id], ['method' => 'DELETE']) }}"
                      class="btn btn-danger">Eliminar</a>
                    @endif

                  </div>
                </div>
                <br />
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
