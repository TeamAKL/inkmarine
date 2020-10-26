@extends('layouts.master')

@section('content')
<div class="container">
    <div class="module-title">
        <h2 class="title"><span>INK Marine Co.,Ltd. Crew Management Database System</span></h2>
    </div>
    <div class="module-content">
        <div class="custom">
            <p>No.176/178, 2<sup>nd</sup> Floor, Botahtaung Pagoda Road (Middle Block), Botahtaung Township, Yangon, Myanmar.</p>
            <p>Email :info@inkmarinemyanmar.com, crewing@inkmarinemyanmar.com, ops@unimarineshipping.com </p>
            <p>Website : www.inkmarinemyanmar.com</p>
            <p>Skype : +959-259255539</p>
            <p>Office Tel : <!--+959-43040201,+951-299181+959-43183687-->+951 299 181, +959 430 40 201, +959 957 543 326</p>
            <p>HP : +959-259255539</p>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
	// jQuery code
    $(window).scroll(function(){
        if ($(this).scrollTop() > 40) {
           $('.navbar').css('height', '70px');

       }else{
        $('.navbar').css('height', 'auto');
    }
});
});
</script>
@endpush
