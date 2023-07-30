@extends('layouts.master')
@section('content')

<div class="container">
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="col-md-6">
                <dl>
                    <dt>Name:</dt>
                    <dd>{{ !empty($product->name) ? $product->name : 'Not set' }}</dd>

                    <dt>Price:</dt>
                    <dd>£{{ !empty($product->price) ? $product->price : 'Not set' }}</dd>

                    <dt>Description:</dt>
                    <dd>{{ !empty($product->description) ? $product->description : 'Not set' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
@endsection