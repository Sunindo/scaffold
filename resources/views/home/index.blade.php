@extends('layouts.master')
@section('content')

<div class="content">

    <div class="card">
        <div class="card-header">
            Products Table
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th>
                                Product Type
                            </th>
                            <th>
                                Product Category
                            </th>
                            <th>
                                Product Name
                            </th>
                            <th>
                                Price (£)
                            </th>
                            <th>
                                Description
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $id => $product)
                        <tr>
                            <td>{{ $product['category_type'] }}</td>
                            <td>{{ $product['category_name'] }}</td>
                            <td><a href="{{ route("product.index", $product['id']) }}">{{ $product['name'] }}</a></td>
                            <td>£{{ $product['price'] }}</td>
                            <td>{{ $product['description'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            paging: true,
            pageLength: 5,
        })
    });
</script>
@endsection