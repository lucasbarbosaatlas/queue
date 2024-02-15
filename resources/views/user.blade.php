@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <h1>Invoices</h1>

            {{-- @can('isAdmin','App\Models\Invoice')
                <a href="">Criar Invoice</a>
            @endcan --}}

            <form action="{{ route('invoice.store') }}" method="post">
                @csrf
                <button type="submit">Create Invoice</button>
            </form>

            <hr>
            <ul>
                @foreach ($invoices as $invoice)
                    <li>{{ $invoice->user->name }} - R$ {{number_format($invoice->value, 2, ',' , '.' )}} 
                    
                        @can('can-edit', $invoice)
                            <a href="/invoice/edit/{{$invoice->id}}">Edit</a>
                        @endcan
                        
                        @can('delete',$invoice)
                            <a href="/invoice/delete/{{$invoice->id}}">Deletar</a>
                        @endcan
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
