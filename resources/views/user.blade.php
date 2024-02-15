@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <h1>Invoices</h1>

            @can('isAdmin','App\Models\Invoice')
                <form action="{{ route('invoice.store') }}" method="post">
                    @csrf
                    <button type="submit">Create Invoice</button>
                </form>
            @endcan

            <hr>
            <ul>
                @foreach ($invoices as $invoice)
                    <li>{{ $invoice->user->name }} - R$ {{number_format($invoice->value, 2, ',' , '.' )}} 
                    
                        @can('can-edit', $invoice)
                            <a href="/invoice/edit/{{$invoice->id}}">Edit</a>
                        @endcan
                        
                        @can('delete', $invoice)
                        <form action="{{ route('invoice.destroy', ['id' => $invoice->id]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; padding: 0;
                            cursor: pointer;
                            color: blue;
                            text-decoration: underline;
                            outline: none; /">Delete</a>
                        </form>
                        @endcan

                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
