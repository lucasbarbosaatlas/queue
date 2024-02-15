@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <form action="{{ route('invoice.update', $invoice->id) }}" method="post">
                @csrf
                <button type="submit">Atualizar Invoice</button>
            </form>
        </div>
    </div>
</div>
@endsection
