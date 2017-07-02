@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @foreach($products as $prd)
                    <div class="col-xs-12 col-sm-6 col-md-6 ">
                    	<div class="thumbnail">
                    		<img src="{{ Storage::url($prd->image) }}" alt="" style="width:80%">
                    		<div class="caption">
                    			<h3>{{$prd->name}}</h3>
                    			<p>
                                    {{Illuminate\Support\Str::words($prd->description, $words = 10, $end = '...')}}

                    			</p>
                                <buttons :product_id="{{$prd->id}}" :favoris="{{(Auth::user()->is_user_favorit_product($prd->id))}}"></buttons>
                    		</div>
                    	</div>
                    </div>
                    @endforeach

                </div>
                {{ $products->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
